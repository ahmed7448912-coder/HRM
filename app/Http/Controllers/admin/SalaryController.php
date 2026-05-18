<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\SalaryTransaction;
use App\Http\Requests\ProcessSalaryRequest;
use App\Services\SalaryService;
use App\Repositories\SalaryRepository;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    function __construct(
        protected SalaryService $salaryService,
        protected SalaryRepository $repo
    ) {}

    public function index()
    {
        if (request()->ajax()) {
            return $this->repo->getDatatable();
        }

        return view('admin.salary.index');
    }

    public function transactions(Request $request)
    {
        if (request()->ajax()) {
            return $this->repo->getTransactionsDatatable();
        }

        return view('admin.salary.transactions');
    }

    public function pay(Salary $salary)
    {
        if ($salary->status === 'paid') {
            return redirect()->route('salary.index')->with('info', 'Salary already paid.');
        }

        return view('admin.salary.payment', compact('salary'));
    }

    public function process(ProcessSalaryRequest $request, Salary $salary)
    {
        if ($salary->status === 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'Already paid.'
            ]);
        }

        try {
            $transaction = $this->salaryService->processSalaryPayment(
                $salary,
                $request->validated('payment_method_id')
            );

            if ($transaction->status === 'success') {
                return response()->json([
                    'success' => true,
                    'message' => "Payment successful for {$salary->employee->name}."
                ]);
            }

            if ($transaction->status === 'pending' && isset($transaction->stripe_response['status']) && $transaction->stripe_response['status'] === 'requires_action') {
                return response()->json([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $transaction->stripe_response['client_secret']
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function confirmPayment(Request $request, Salary $salary)
    {
        $paymentIntentId = $request->input('payment_intent_id');

        if (!$paymentIntentId) {
            return response()->json([
                'success' => false,
                'message' => 'No payment intent ID received.'
            ]);
        }

        try {
            $transaction = $this->salaryService->confirmSalaryPayment($salary, $paymentIntentId);

            return response()->json([
                'success' => true,
                'message' => "Payment successfully verified and confirmed for {$salary->employee->name}."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function resendEmail(Salary $salary)
    {
        try {
            $this->salaryService->resendReceiptEmail($salary);

            return back()->with('success', 'Receipt email queued for ' . $salary->employee->email);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function cancel(Salary $salary)
    {
        try {
            $salary->update([
                'status'            => 'unpaid',
                'paid_at'           => null,
                'payment_reference' => null,
            ]);

            $salary->transactions()->where('status', 'success')->update([
                'status' => 'failed',
            ]);

            return back()->with('success', "Payment successfully cancelled for {$salary->employee->name}. You can now pay them again.");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroyTransaction(SalaryTransaction $transaction)
    {
        try {
            $transaction->delete();
            return back()->with('success', 'Transaction log successfully deleted.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
