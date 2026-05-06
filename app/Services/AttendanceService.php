<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Employees;
use App\Repositories\AttendanceRepository;

class AttendanceService
{
    protected $repo;

    public function __construct(AttendanceRepository $repo)
    {
        $this->repo = $repo;
    }

    // manual attendance (form / admin)
    public function mark(array $data)
    {
        return $this->repo->updateOrCreate(
            [
                'employee_id' => $data['employee_id'],
                'date' => $data['date']
            ],
            [
                'check_in' => $data['check_in'] ?? null,
                'check_out' => $data['check_out'] ?? null
            ]
        );
    }

    //  AUTO ABSENT LOGIC
    public function markAbsentEmployees($date)
    {
        $allEmployees = \App\Models\Employees::pluck('id')->toArray();

        $presentEmployees = $this->repo->getByDate($date);

        $absentEmployees = array_diff($allEmployees, $presentEmployees);

        foreach ($absentEmployees as $empId) {
            $this->repo->create([
                'employee_id' => $empId,
                'date' => $date,
                'status' => 'absent',
                'check_in' => null,
                'check_out' => null
            ]);
        }
    }
}
