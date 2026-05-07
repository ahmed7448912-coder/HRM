<?php

namespace App\Services;

use App\Repositories\PerformanceRepository;
use App\Models\Performance;
use Yajra\DataTables\Facades\DataTables;

class PerformanceService
{
    protected $repo;

    public function __construct(PerformanceRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(Performance $performance, array $data)
    {
        return $this->repo->update($performance, $data);
    }

    public function delete(Performance $performance)
    {
        return $this->repo->delete($performance);
    }

    public function getDatatable()
    {
        $performances = Performance::with('employee')->select('performances.*');

        return DataTables::of($performances)
            ->addIndexColumn()
            ->addColumn('employee', fn($row) => $row->employee->name ?? '-')
            ->addColumn('rating', function($row) {
                $stars = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $row->rating) {
                        $stars .= '<i class="bi bi-star-fill text-warning"></i>';
                    } else {
                        $stars .= '<i class="bi bi-star text-muted"></i>';
                    }
                }
                return $stars;
            })
            ->addColumn('formatted_date', fn($row) => date('M d, Y', strtotime($row->review_date)))
            ->addColumn('actions', 'admin.performance._actions')
            ->rawColumns(['rating', 'actions'])
            ->make(true);
    }
}
