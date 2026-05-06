<?php

namespace App\Services;

use App\Jobs\SendEmployeeWelcomeMailJob;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeWelcomeMail;
use App\Models\Employee;
use App\Models\Employees;
use App\Repositories\EmployeeRepository;

class EmployeeService
{
    use UploadTrait;

    protected $repo;

    public function __construct(EmployeeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getDatatable()
    {
        $query = $this->repo->all(); // Assuming repo->all() returns the query builder or collection

        return \Yajra\DataTables\Facades\DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('department', function ($row) {
                return $row->department->name ?? '-';
            })
            ->addColumn('actions', 'admin.employees._actions')
            ->addColumn('image', function ($row) {
                if (!$row->image) {
                    return '<img src="' . asset('assets/img/avatar5.png') . '" class="img-circle" width="50" height="50" style="object-fit: cover;">';
                }
                return '<img src="' . asset('storage/' . $row->image) . '" class="img-circle" width="50" height="50" style="object-fit: cover;">';
            })
            ->rawColumns(['image', 'actions'])
            ->make(true);
    }

    public function create(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->uploadFile($data['image'], 'employees');
        }

        $employee = $this->repo->create($data);

        // ✅ dispatch job instead of sending mail directly
        dispatch(new SendEmployeeWelcomeMailJob($employee));

        return $employee;
    }

    public function update(Employees $employee, array $data)
    {
        // check if new image uploaded
        if (isset($data['image'])) {

            // delete old image
            $this->deleteFile($employee->image);

            // upload new image
            $data['image'] = $this->uploadFile($data['image'], 'employees');
        }

        return $this->repo->update($employee, $data);
    }

    public function delete(Employees $employee)
    {
        return $this->repo->delete($employee);
    }
}
