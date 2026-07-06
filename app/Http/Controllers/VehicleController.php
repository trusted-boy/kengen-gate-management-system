<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = request('per_page', 10);

        $vehicles = Vehicle::when($search, function ($query) use ($search) {
            return $query->where('registration_number', 'like', "%{$search}%")
                        ->orWhere('vehicle_type', 'like', "%{$search}%")
                        ->orWhere('owner_name', 'like', "%{$search}%");
        })->latest()->paginate($perPage);

        return view('vehicles.index', compact('vehicles', 'search', 'perPage'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required',
            'vehicle_type' => 'required',
            'make_model' => 'required',
            'year' => 'required|digits:4',
            'color' => 'nullable',
            'owner_name' => 'required',
            'owner_contact' => 'required',
            'driver_name' => 'nullable',
            'driver_license_number' => 'nullable',
            'status' => 'required|in:Active,Inactive,Under Maintenance',
            'remarks' => 'nullable',
        ]);

        // Allow multiple check-ins for same vehicle
        $validated['check_in_time'] = now();
        $validated['visit_status'] = 'IN';

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle checked in successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'registration_number' => 'required|unique:vehicles,registration_number,' . $vehicle->id,
            'vehicle_type' => 'required',
            'make_model' => 'required',
            'year' => 'required|digits:4',
            'color' => 'nullable',
            'owner_name' => 'required',
            'owner_contact' => 'required',
            'driver_name' => 'nullable',
            'driver_license_number' => 'nullable',
            'status' => 'required|in:Active,Inactive,Under Maintenance',
            'remarks' => 'nullable',
        ]);

        if ($request->filled('visit_status') && $request->visit_status === 'OUT' && $vehicle->visit_status === 'IN') {
            $validated['check_out_time'] = now();
            $validated['visit_status'] = 'OUT';
        }

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function checkout(Vehicle $vehicle)
    {
        $vehicle->update([
            'visit_status' => 'OUT',
            'check_out_time' => now(),
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle checked out successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    /**
     * API endpoint to retrieve vehicle details by registration number for auto-fill
     */
    public function getVehicleDetails(Request $request)
    {
        $registrationNumber = $request->query('registration_number');
        
        if (!$registrationNumber) {
            return response()->json(['error' => 'Registration number required'], 400);
        }

        $vehicle = Vehicle::where('registration_number', $registrationNumber)
                          ->latest()
                          ->first();

        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        return response()->json([
            'vehicle_type' => $vehicle->vehicle_type,
            'make_model' => $vehicle->make_model,
            'year' => $vehicle->year,
            'color' => $vehicle->color,
            'owner_name' => $vehicle->owner_name,
            'owner_contact' => $vehicle->owner_contact,
            'driver_name' => $vehicle->driver_name,
            'driver_license_number' => $vehicle->driver_license_number,
            'status' => $vehicle->status,
        ]);
    }
}
