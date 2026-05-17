<?php

namespace App\Repositories;

use App\Models\Salary;
use App\Models\SalaryTransaction;
use Illuminate\Pagination\LengthAwarePaginator;

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
}
