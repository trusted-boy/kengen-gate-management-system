<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = request('per_page', 10);

        $visitors = Visitor::when($search, function ($query) use ($search) {
            return $query->where('full_name', 'like', "%{$search}%")
                        ->orWhere('id_number', 'like', "%{$search}%")
                        ->orWhere('vehicle_registration', 'like', "%{$search}%")
                        ->orWhere('host_name', 'like', "%{$search}%");
        })->latest()->paginate($perPage);

        return view('visitors.index', compact('visitors', 'search', 'perPage'));
    }

    public function create()
    {
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:50',
            'phone' => 'nullable|string|max:20',
            'vehicle_registration' => 'nullable|string|max:50',
            'number_of_visitors' => 'required|integer|min:1',
            'reason_for_visit' => 'nullable|string|max:255',
            'host_name' => 'required|string|max:255',
            'whom_to_see' => 'nullable|string|max:255',
            'department' => 'required|string|max:255',
            'purpose' => 'required|string',
            'signature' => 'required|string|max:255',
        ]);

        $validated['check_in_time'] = now();
        $validated['status'] = 'IN';

        Visitor::create($validated);

        return redirect()->route('visitors.index')->with('success', 'Visitor checked in successfully.');
    }

    public function show(Visitor $visitor)
    {
        return view('visitors.show', compact('visitor'));
    }

    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', compact('visitor'));
    }

    public function update(Request $request, Visitor $visitor)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'id_number' => 'required|unique:visitors,id_number,' . $visitor->id,
            'phone' => 'nullable|string|max:20',
            'vehicle_registration' => 'nullable|string|max:50',
            'number_of_visitors' => 'required|integer|min:1',
            'reason_for_visit' => 'nullable|string|max:255',
            'host_name' => 'required|string|max:255',
            'whom_to_see' => 'nullable|string|max:255',
            'department' => 'required|string|max:255', // ADDED: Department validation
            'purpose' => 'required|string',
            'status' => 'required|in:IN,OUT',
            'signature' => 'nullable|string|max:255',
        ]);

        if ($request->filled('status') && $request->status === 'OUT' && $visitor->status === 'IN') {
            $validated['check_out_time'] = now();
        }

        $visitor->update($validated);

        return redirect()->route('visitors.index')->with('success', 'Visitor updated successfully.');
    }

    public function checkout(Visitor $visitor)
    {
        $visitor->update([
            'status' => 'OUT',
            'check_out_time' => now(),
        ]);

        return redirect()->route('visitors.index')->with('success', 'Visitor checked out successfully.');
    }

    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return redirect()->route('visitors.index')->with('success', 'Visitor record deleted successfully.');
    }

    /**
     * API endpoint to retrieve visitor details by ID for auto-fill
     */
    public function getVisitorDetails(Request $request)
    {
        $idNumber = $request->query('id_number');
        
        if (!$idNumber) {
            return response()->json(['error' => 'ID number required'], 400);
        }

        $visitor = Visitor::where('id_number', $idNumber)
                         ->latest()
                         ->first();

        if (!$visitor) {
            return response()->json(['error' => 'Visitor not found'], 404);
        }

        return response()->json([
            'full_name' => $visitor->full_name,
            'phone' => $visitor->phone,
            'vehicle_registration' => $visitor->vehicle_registration,
            'department' => $visitor->department,
        ]);
    }
}
