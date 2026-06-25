<?php

namespace App\Http\Controllers;

use App\Models\Visitor;

class DashboardController extends Controller
{
    public function index()
{
    $visitorsInside = Visitor::where('status', 'IN')->count();

    $visitorsOutside = Visitor::where('status', 'OUT')->count();

    $todayVisitors = Visitor::whereDate('created_at', now()->toDateString())->count();

    $totalVisitors = Visitor::count();

    return view('dashboard', compact(
        'visitorsInside',
        'visitorsOutside',
        'todayVisitors',
        'totalVisitors'
    ));
}
}
