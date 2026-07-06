<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = request('per_page', 10);

        $staff = Staff::when($search, function ($query) use ($search) {
            return $query->where('full_name', 'like', "%{$search}%")
                        ->orWhere('staff_id', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
        })->latest()->paginate($perPage);

        return view('staff.index', compact('staff', 'search', 'perPage'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|unique:staff',
            'full_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'vehicle_registration' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['check_in_time'] = now();
        $validated['status'] = 'IN';

        Staff::create($validated);

        return redirect()->route('staff.index')->with('success', 'Staff checked in successfully.');
    }

    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'staff_id' => 'required|unique:staff,staff_id,' . $staff->id,
            'full_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'vehicle_registration' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:IN,OUT',
        ]);

        if ($request->filled('status') && $request->status === 'OUT' && $staff->status === 'IN') {
            $validated['check_out_time'] = now();
        }

        $staff->update($validated);

        return redirect()->route('staff.index')->with('success', 'Staff record updated successfully.');
    }

    public function checkout(Staff $staff)
    {
        $staff->update([
            'status' => 'OUT',
            'check_out_time' => now(),
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff checked out successfully.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff record deleted successfully.');
    }

    /**
     * API endpoint to retrieve staff details by ID for auto-fill
     */
    public function getStaffDetails(Request $request)
    {
        $staffId = $request->query('staff_id');
        
        if (!$staffId) {
            return response()->json(['error' => 'Staff ID required'], 400);
        }

        $staff = Staff::where('staff_id', $staffId)->first();

        if (!$staff) {
            return response()->json(['error' => 'Staff not found'], 404);
        }

        return response()->json([
            'full_name' => $staff->full_name,
            'department' => $staff->department,
            'vehicle_registration' => $staff->vehicle_registration,
            'phone' => $staff->phone,
        ]);
    }
}
