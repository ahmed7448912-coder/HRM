<?php

namespace App\Services;

use App\Models\Leave;
use App\Repositories\LeaveRepository;

class LeaveService
{
    public function __construct(private LeaveRepository $repo) {}

    public function all()
    {
        return $this->repo->all();
    }

    public function apply(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(Leave $leave, array $data)
    {
        return $this->repo->update($leave, $data);
    }

    public function delete(Leave $leave)
    {
        return $this->repo->delete($leave);
    }

    public function getDataTable()
    {
        $leaves = $this->repo->all();

        return \Yajra\DataTables\Facades\DataTables::of($leaves)
            ->addIndexColumn()
            ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
            ->addColumn('status', function ($row) {
                $statusOptions = ['pending', 'approved', 'rejected'];
                $color = [
                    'pending' => 'color: #856404; background-color: #fff3cd;',
                    'approved' => 'color: #155724; background-color: #d4edda;',
                    'rejected' => 'color: #721c24; background-color: #f8d7da;'
                ][$row->status] ?? '';

                $html = '<select class="form-select form-select-sm statusDropdown" data-id="' . $row->id . '" style="width: 125px; font-weight: bold; ' . $color . '">';

                foreach ($statusOptions as $status) {
                    $selected = ($row->status == $status) ? 'selected' : '';
                    $optColor = [
                        'pending' => 'color: #856404; background-color: #fff3cd;',
                        'approved' => 'color: #155724; background-color: #d4edda;',
                        'rejected' => 'color: #721c24; background-color: #f8d7da;'
                    ][$status] ?? '';

                    $html .= '<option value="' . $status . '" ' . $selected . ' style="' . $optColor . '">' . ucfirst($status) . '</option>';
                }

                $html .= '</select>';
                return $html;
            })
            ->addColumn('actions', function ($row) {
                return '
                    <div class="btn-group">
                        <a href="' . route('leave.show', $row->id) . '" class="btn btn-sm btn-info text-white" title="Show"><i class="bi bi-eye"></i></a>
                        <a href="' . route('leave.edit', $row->id) . '" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <button data-id="' . $row->id . '" class="btn btn-sm btn-danger deleteBtn" title="Delete"><i class="bi bi-trash"></i></button>
                    </div>
                ';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
