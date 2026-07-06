<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\InternsAttachee;
use App\Models\Vehicle;
use App\Models\Contractor;
use App\Models\Staff;
use App\Models\EquipmentMovement;
use App\Models\Department;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        // Visitor statistics
        $visitorsInside = Visitor::where('status', 'IN')->count();
        $visitorsOutside = Visitor::where('status', 'OUT')->count();
        $todayVisitors = Visitor::whereDate('created_at', now()->toDateString())->count();
        $totalVisitors = Visitor::count();

        // Interns statistics
        $internsPresent = InternsAttachee::where('status', 'IN')->count();
        $todayInterns = InternsAttachee::whereDate('created_at', now()->toDateString())->count();
        $totalInterns = InternsAttachee::count();

        // Staff statistics
        $staffPresent = Staff::where('status', 'IN')->count();
        $todayStaff = Staff::whereDate('created_at', now()->toDateString())->count();
        $totalStaff = Staff::count();

        // Vehicle statistics
        $vehiclesInside = Vehicle::where('visit_status', 'IN')->count();
        $vehiclesCheckedOut = Vehicle::where('visit_status', 'OUT')->count();
        $todayVehicles = Vehicle::whereDate('created_at', now()->toDateString())->count();
        $totalVehicles = Vehicle::count();

        // Contractor statistics
        $contractorsPresent = Contractor::where('visit_status', 'IN')->count();
        $contractorsCheckedOut = Contractor::where('visit_status', 'OUT')->count();
        $todayContractors = Contractor::whereDate('created_at', now()->toDateString())->count();
        $totalContractors = Contractor::count();

        // Recent activities
        $lastVisitorCheckIn = Visitor::where('status', 'IN')->latest()->first();
        $lastVisitorCheckOut = Visitor::where('status', 'OUT')->latest()->first();
        $lastStaffCheckIn = Staff::where('status', 'IN')->latest()->first();
        $lastVehicleCheckIn = Vehicle::where('visit_status', 'IN')->latest()->first();
        $lastContractorCheckIn = Contractor::where('visit_status', 'IN')->latest()->first();

        // Equipment statistics
        $equipmentOut = EquipmentMovement::where('status', 'Out')->count();
        $totalMovements = EquipmentMovement::count();

        $totalDepartments = Department::count();

        return view('dashboard', compact(
            'visitorsInside',
            'visitorsOutside',
            'todayVisitors',
            'totalVisitors',
            'internsPresent',
            'todayInterns',
            'totalInterns',
            'staffPresent',
            'todayStaff',
            'totalStaff',
            'vehiclesInside',
            'vehiclesCheckedOut',
            'todayVehicles',
            'totalVehicles',
            'contractorsPresent',
            'contractorsCheckedOut',
            'todayContractors',
            'totalContractors',
            'lastVisitorCheckIn',
            'lastVisitorCheckOut',
            'lastStaffCheckIn',
            'lastVehicleCheckIn',
            'lastContractorCheckIn',
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
            'internsPresent' => InternsAttachee::where('status', 'IN')->count(),
            'todayInterns' => InternsAttachee::whereDate('created_at', now()->toDateString())->count(),
            'totalInterns' => InternsAttachee::count(),
            'staffPresent' => Staff::where('status', 'IN')->count(),
            'todayStaff' => Staff::whereDate('created_at', now()->toDateString())->count(),
            'totalStaff' => Staff::count(),
            'vehiclesInside' => Vehicle::where('visit_status', 'IN')->count(),
            'todayVehicles' => Vehicle::whereDate('created_at', now()->toDateString())->count(),
            'totalVehicles' => Vehicle::count(),
            'contractorsPresent' => Contractor::where('visit_status', 'IN')->count(),
            'todayContractors' => Contractor::whereDate('created_at', now()->toDateString())->count(),
            'totalContractors' => Contractor::count(),
            'equipmentOut' => EquipmentMovement::where('status', 'Out')->count(),
            'totalMovements' => EquipmentMovement::count(),
            'totalDepartments' => Department::count(),
            'visitors' => Visitor::latest()->limit(10)->get(),
            'interns' => InternsAttachee::latest()->limit(10)->get(),
            'staff' => Staff::latest()->limit(10)->get(),
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
