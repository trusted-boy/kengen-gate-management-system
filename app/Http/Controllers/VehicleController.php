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
        })->paginate($perPage);

        return view('vehicles.index', compact('vehicles', 'search', 'perPage'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required|unique:vehicles',
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

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully.');
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

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
