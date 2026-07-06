<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = request('per_page', 10);

        $contractors = Contractor::when($search, function ($query) use ($search) {
            return $query->where('company_name', 'like', "%{$search}%")
                        ->orWhere('contact_person', 'like', "%{$search}%")
                        ->orWhere('license_number', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
        })->latest()->paginate($perPage);

        return view('contractors.index', compact('contractors', 'search', 'perPage'));
    }

    public function create()
    {
        return view('contractors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required',
            'contact_person' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'license_number' => 'required',
            'license_expiry' => 'required|date',
            'services_offered' => 'required',
            'status' => 'required|in:Active,Inactive,Expired',
            'remarks' => 'nullable',
        ]);

        // Allow multiple check-ins for same contractor
        $validated['check_in_time'] = now();
        $validated['visit_status'] = 'IN';

        Contractor::create($validated);

        return redirect()->route('contractors.index')->with('success', 'Contractor checked in successfully.');
    }

    public function show(Contractor $contractor)
    {
        return view('contractors.show', compact('contractor'));
    }

    public function edit(Contractor $contractor)
    {
        return view('contractors.edit', compact('contractor'));
    }

    public function update(Request $request, Contractor $contractor)
    {
        $validated = $request->validate([
            'company_name' => 'required|unique:contractors,company_name,' . $contractor->id,
            'contact_person' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'license_number' => 'required|unique:contractors,license_number,' . $contractor->id,
            'license_expiry' => 'required|date',
            'services_offered' => 'required',
            'status' => 'required|in:Active,Inactive,Expired',
            'remarks' => 'nullable',
        ]);

        if ($request->filled('visit_status') && $request->visit_status === 'OUT' && $contractor->visit_status === 'IN') {
            $validated['check_out_time'] = now();
            $validated['visit_status'] = 'OUT';
        }

        $contractor->update($validated);

        return redirect()->route('contractors.index')->with('success', 'Contractor updated successfully.');
    }

    public function checkout(Contractor $contractor)
    {
        $contractor->update([
            'visit_status' => 'OUT',
            'check_out_time' => now(),
        ]);

        return redirect()->route('contractors.index')->with('success', 'Contractor checked out successfully.');
    }

    public function destroy(Contractor $contractor)
    {
        $contractor->delete();

        return redirect()->route('contractors.index')->with('success', 'Contractor deleted successfully.');
    }

    /**
     * API endpoint to retrieve contractor details by license number for auto-fill
     */
    public function getContractorDetails(Request $request)
    {
        $licenseNumber = $request->query('license_number');
        
        if (!$licenseNumber) {
            return response()->json(['error' => 'License number required'], 400);
        }

        $contractor = Contractor::where('license_number', $licenseNumber)
                               ->latest()
                               ->first();

        if (!$contractor) {
            return response()->json(['error' => 'Contractor not found'], 404);
        }

        return response()->json([
            'company_name' => $contractor->company_name,
            'contact_person' => $contractor->contact_person,
            'email' => $contractor->email,
            'phone' => $contractor->phone,
            'license_expiry' => $contractor->license_expiry,
            'services_offered' => $contractor->services_offered,
            'status' => $contractor->status,
        ]);
    }
}
