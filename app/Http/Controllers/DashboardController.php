<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Vehicle;
use App\Models\Contractor;
use App\Models\EquipmentMovement;
use App\Models\Department;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $visitorsInside = Visitor::where('status', 'IN')->count();
        $visitorsOutside = Visitor::where('status', 'OUT')->count();
        $todayVisitors = Visitor::whereDate('created_at', now()->toDateString())->count();
        $totalVisitors = Visitor::count();

        $activeVehicles = Vehicle::where('status', 'Active')->count();
        $totalVehicles = Vehicle::count();

        $activeContractors = Contractor::where('status', 'Active')->count();
        $totalContractors = Contractor::count();

        $equipmentOut = EquipmentMovement::where('status', 'Out')->count();
        $totalMovements = EquipmentMovement::count();

        $totalDepartments = Department::count();

        return view('dashboard', compact(
            'visitorsInside',
            'visitorsOutside',
            'todayVisitors',
            'totalVisitors',
            'activeVehicles',
            'totalVehicles',
            'activeContractors',
            'totalContractors',
            'equipmentOut',
            'totalMovements',
            'totalDepartments'
        ));
    }

    public function exportPdf()
    {
        $data = [
            'visitorsInside' => Visitor::where('status', 'IN')->count(),
            'visitorsOutside' => Visitor::where('status', 'OUT')->count(),
            'todayVisitors' => Visitor::whereDate('created_at', now()->toDateString())->count(),
            'totalVisitors' => Visitor::count(),
            'activeVehicles' => Vehicle::where('status', 'Active')->count(),
            'totalVehicles' => Vehicle::count(),
            'activeContractors' => Contractor::where('status', 'Active')->count(),
            'totalContractors' => Contractor::count(),
            'equipmentOut' => EquipmentMovement::where('status', 'Out')->count(),
            'totalMovements' => EquipmentMovement::count(),
            'totalDepartments' => Department::count(),
            'visitors' => Visitor::latest()->limit(10)->get(),
            'vehicles' => Vehicle::latest()->limit(10)->get(),
            'contractors' => Contractor::latest()->limit(10)->get(),
            'equipments' => EquipmentMovement::latest()->limit(10)->get(),
        ];

        $pdf = Pdf::loadView('reports.pdf', $data);
        return $pdf->download('gate-management-report-' . now()->format('Y-m-d-H-i-s') . '.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new ReportsExport, 'gate-management-report-' . now()->format('Y-m-d-H-i-s') . '.xlsx');
    }
}
