<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
{
    $visitors = Visitor::latest()->get();
    return view('visitors.index', compact('visitors'));
}

    public function create()
    {
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        Visitor::create([
            'full_name' => $request->full_name,
            'id_number' => $request->id_number,
            'phone' => $request->phone,
            'organization' => $request->organization,
            'host_name' => $request->host_name,
            'department' => $request->department,
            'purpose' => $request->purpose,
            'check_in_time' => now(),
            'status' => 'IN'
        ]);

        return redirect('/visitors');
    }
}
