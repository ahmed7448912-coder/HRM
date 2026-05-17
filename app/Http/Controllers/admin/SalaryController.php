<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Http\Requests\ProcessSalaryRequest;
use App\Jobs\ProcessSalaryPaymentJob;
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
        $salaries = $this->repo->allPaginated();
        return view('admin.salary.index', compact('salaries'));
    }

    public function transactions(Request $request)
    {
        $filters = $request->only(['status', 'month', 'employee']);
        $transactions = $this->repo->filteredTransactions($filters);

        return view('admin.salary.transactions', compact('transactions'));
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
            return redirect()->route('salary.index')
                ->with('info', 'Already paid.');
        }

        // Dispatch to queue — returns instantly
        ProcessSalaryPaymentJob::dispatch(
            $salary,
            $request->validated('payment_method_id')
        );

        return redirect()->route('salary.index')
            ->with('success', "Payment queued for {$salary->employee->name}. You will be notified on completion.");
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
}
