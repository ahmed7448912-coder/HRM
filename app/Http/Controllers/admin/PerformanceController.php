<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PerformanceRequest;
use App\Models\Performance;
use App\Models\Employees;
use App\Services\PerformanceService;

class PerformanceController extends Controller
{
    protected $service;

    public function __construct(PerformanceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->service->getDatatable();
        }
        $employees = Employees::pluck('name', 'id');
        return view('admin.performance.index', compact('employees'));
    }

    public function store(PerformanceRequest $request)
    {
        $this->service->create($request->validated());
        return response()->json(['success' => true, 'message' => 'Review added successfully!']);
    }

    public function update(PerformanceRequest $request, Performance $performance)
    {
        $this->service->update($performance, $request->validated());
        return response()->json(['success' => true, 'message' => 'Review updated successfully!']);
    }

    public function destroy(Performance $performance)
    {
        $this->service->delete($performance);
        return response()->json(['success' => true, 'message' => 'Review deleted successfully!']);
    }
}
