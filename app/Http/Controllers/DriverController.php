<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverCreateRequest;
use App\Http\Requests\DriverUpdateRequest;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = (int) request('per_page', 10);

        $drivers = Driver::query()
            ->when($search, function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('employee_id', 'like', "%{$search}%")
                    ->orWhere('license_number', 'like', "%{$search}%");
            })
            ->latest('id')
            ->paginate($perPage);

        return view('drivers.index', compact('drivers', 'search', 'perPage'));
    }

    public function create()
    {
        $vehicles = Vehicle::orderBy('registration_number')->get();
        return view('drivers.create', compact('vehicles'));
    }

    public function store(DriverCreateRequest $request)
    {
        $validated = $request->validated();

        $vehicleIds = $validated['vehicle_ids'] ?? [];
        unset($validated['vehicle_ids']);

        $driver = Driver::create($validated);
        if (!empty($vehicleIds)) {
            $driver->vehicles()->sync($vehicleIds);
        }

        return redirect()->route('drivers.index')->with('success', 'Driver created successfully.');
    }

    public function show(Driver $driver)
    {
        $driver->load('vehicles');
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $vehicles = Vehicle::orderBy('registration_number')->get();
        $driver->load('vehicles');

        $selectedVehicleIds = $driver->vehicles->pluck('id')->all();
        return view('drivers.edit', compact('driver', 'vehicles', 'selectedVehicleIds'));
    }

    public function update(DriverUpdateRequest $request, Driver $driver)
    {
        $validated = $request->validated();

        $vehicleIds = $validated['vehicle_ids'] ?? [];
        unset($validated['vehicle_ids']);

        $driver->update($validated);
        $driver->vehicles()->sync($vehicleIds);

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }
}

