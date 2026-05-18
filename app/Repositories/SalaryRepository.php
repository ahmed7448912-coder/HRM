<?php

namespace App\Repositories;

use App\Models\Salary;
use App\Models\SalaryTransaction;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\DataTables\Facades\DataTables;

class SalaryRepository
{
    public function allPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return Salary::with(['employee', 'transactions'])
            ->latest()
            ->paginate($perPage);
    }

    public function findById(int $id): Salary
    {
        return Salary::with('employee')->findOrFail($id);
    }

    public function markAsPaid(Salary $salary, string $paymentReference): void
    {
        $salary->update([
            'status'            => 'paid',
            'paid_at'           => now(),
            'payment_reference' => $paymentReference,
        ]);
    }

    public function saveTransaction(array $data): SalaryTransaction
    {
        return SalaryTransaction::create($data);
    }

    public function updateTransactionEmail(SalaryTransaction $tx): void
    {
        $tx->update(['email_sent_at' => now()]);
    }

    public function getLastTransaction(Salary $salary): ?SalaryTransaction
    {
        return $salary->transactions()->latest()->first();
    }

    public function filteredTransactions(array $filters, int $perPage = 25): LengthAwarePaginator
    {
        $query = SalaryTransaction::with(['salary.employee'])->latest();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['month'])) {
            $query->whereHas(
                'salary',
                fn($q) =>
                $q->where('month', $filters['month'])
            );
        }

        if (!empty($filters['employee'])) {
            $query->whereHas(
                'salary.employee',
                fn($q) =>
                $q->where('name', 'like', '%' . $filters['employee'] . '%')
            );
        }

        return $query->paginate($perPage);
    }

    public function getDatatable()
    {
        $salaries = Salary::with('employee')->select('salaries.*');

        return DataTables::of($salaries)
            ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
            ->editColumn('amount', fn($row) => '$' . number_format($row->amount, 2))
            ->editColumn('status', function($row) {
                if($row->status === 'paid') {
                    return '<span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 border border-success border-opacity-25">Paid</span>';
                }
                return '<span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 border border-warning border-opacity-25">Unpaid</span>';
            })
            ->editColumn('paid_at', fn($row) => $row->paid_at ? $row->paid_at->format('d M Y') : '—')
            ->addColumn('email_status', function($row) {
                $tx = $row->transactions->last();
                if($tx && $tx->email_sent_at) {
                    return '<small class="text-success d-flex align-items-center"><i class="bi bi-check2-all me-1"></i> Sent ' . $tx->email_sent_at->format('d M, h:i A') . '</small>';
                }
                return '<small class="text-muted"><i class="bi bi-envelope-x me-1"></i> Not sent</small>';
            })
            ->addColumn('actions', function($row) {
                return view('admin.salary._actions', [
                    'id'     => $row->id,
                    'status' => $row->status,
                ])->render();
            })
            ->rawColumns(['status', 'email_status', 'actions'])
            ->make(true);
    }

    public function getTransactionsDatatable()
    {
        $transactions = SalaryTransaction::with('salary.employee')->select('salary_transactions.*');

        return DataTables::of($transactions)
            ->addColumn('employee', fn($row) => $row->salary->employee->name ?? '-')
            ->addColumn('month', fn($row) => $row->salary->month ?? '-')
            ->editColumn('amount', fn($row) => '<span class="text-success fw-bold">$' . number_format($row->amount, 2) . '</span>')
            ->editColumn('payment_method', function($row) {
                return '<span class="badge bg-light text-dark border"><i class="bi bi-credit-card me-1"></i> ' . ucfirst($row->payment_method) . '</span>';
            })
            ->editColumn('status', function($row) {
                if($row->status === 'success') {
                    return '<span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 border border-success border-opacity-25">Success</span>';
                }
                return '<span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 border border-danger border-opacity-25">Failed</span>';
            })
            ->editColumn('transaction_id', fn($row) => '<span class="font-monospace small text-muted">' . $row->transaction_id . '</span>')
            ->editColumn('created_at', fn($row) => $row->created_at->format('d M Y, h:i A'))
            ->addColumn('actions', function($row) {
                return '<form action="'.route('salary.transactions.destroy', $row->id).'" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure you want to delete this transaction log?\');">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 px-2 shadow-sm" title="Delete Transaction Log">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>';
            })
            ->rawColumns(['amount', 'payment_method', 'status', 'transaction_id', 'actions'])
            ->make(true);
    }
}
