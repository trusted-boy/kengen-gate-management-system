<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleTrip;
use App\Models\VehicleTripPassenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleTripController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = (int) request('per_page', 10);

        $trips = VehicleTrip::query()
            ->with(['vehicle', 'driver'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('vehicle', function ($v) use ($search) {
                    $v->where('registration_number', 'like', "%{$search}%")
                        ->orWhere('vehicle_type', 'like', "%{$search}%");
                })
                ->orWhereHas('driver', function ($d) use ($search) {
                    $d->where('full_name', 'like', "%{$search}%")
                      ->orWhere('license_number', 'like', "%{$search}%");
                })
                ->orWhere('destination', 'like', "%{$search}%")
                ->orWhere('purpose_of_trip', 'like', "%{$search}%");
            })
            ->latest('departure_at')
            ->paginate($perPage);

        return view('vehicle_trips.index', compact('trips', 'search', 'perPage'));
    }

    public function create()
    {
        $vehicles = Vehicle::orderBy('registration_number')->get();
        $drivers = Driver::where('status', 'Active')->orderBy('full_name')->get();

        return view('vehicle_trips.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'departure_gate' => 'required|string|max:100',
            'return_gate' => 'required|string|max:100',
            'destination' => 'required|string|max:255',
            'purpose_of_trip' => 'required|string|max:255',

            'departure_at' => 'required|date',

            'expected_return_at' => 'required|date|after_or_equal:departure_at',
            'departure_odometer_km' => 'required|integer|min:0',
            'return_odometer_km' => 'required_if:status,Completed|nullable|integer|min:0',
            'remarks' => 'nullable|string|max:1000',
            'status' => 'required|in:Active,Completed,Overdue',

            'staff_count' => 'nullable|integer|min:0',
            'attachee_count' => 'nullable|integer|min:0',
            'contractor_count' => 'nullable|integer|min:0',
            'visitor_count' => 'nullable|integer|min:0',

            'staff_names' => 'nullable|string',
            'attachee_names' => 'nullable|string',
            'contractor_names' => 'nullable|string',
            'visitor_names' => 'nullable|string',
        ]);

        // Enforce mileage rules
        if (isset($validated['return_odometer_km'])) {
            if ($validated['return_odometer_km'] < $validated['departure_odometer_km']) {
                return back()->withErrors(['return_odometer_km' => 'Return mileage cannot be lower than departure mileage.'])->withInput();
            }
        }

        $distanceKm = 0;
        if (isset($validated['return_odometer_km'])) {
            $distanceKm = $validated['return_odometer_km'] - $validated['departure_odometer_km'];
        }
        $validated['distance_km'] = $distanceKm;

        if ($validated['status'] !== 'Active' && !isset($validated['actual_return_at'])) {
            // controller currently does not accept actual_return_at in request; handle based on status.
            $validated['actual_return_at'] = now();
        }

        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        $trip = VehicleTrip::create($validated);

        $this->storePassengers($trip, $validated);

        return redirect()->route('vehicle_trips.index')->with('success', 'Vehicle trip recorded successfully.');
    }

    public function show(VehicleTrip $vehicleTrip)
    {
        $vehicleTrip->load(['vehicle', 'driver', 'passengers']);
        return view('vehicle_trips.show', compact('vehicleTrip'));
    }

    public function edit(VehicleTrip $vehicleTrip)
    {
        $vehicles = Vehicle::orderBy('registration_number')->get();
        $drivers = Driver::where('status', 'Active')->orderBy('full_name')->get();
        $vehicleTrip->load('passengers');

        return view('vehicle_trips.edit', compact('vehicleTrip', 'vehicles', 'drivers'));
    }

    public function update(Request $request, VehicleTrip $vehicleTrip)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'departure_gate' => 'required|string|max:100',
            'return_gate' => 'required|string|max:100',
            'destination' => 'required|string|max:255',
            'purpose_of_trip' => 'required|string|max:255',
            'departure_at' => 'required|date',
            'expected_return_at' => 'required|date|after_or_equal:departure_at',
            'actual_return_at' => 'nullable|date',

            'departure_odometer_km' => 'required|integer|min:0',
            'return_odometer_km' => 'required_if:status,Completed|nullable|integer|min:0',
            'status' => 'required|in:Active,Completed,Overdue',

            'remarks' => 'nullable|string|max:1000',

            'staff_count' => 'nullable|integer|min:0',
            'attachee_count' => 'nullable|integer|min:0',
            'contractor_count' => 'nullable|integer|min:0',
            'visitor_count' => 'nullable|integer|min:0',

            'staff_names' => 'nullable|string',
            'attachee_names' => 'nullable|string',
            'contractor_names' => 'nullable|string',
            'visitor_names' => 'nullable|string',
        ]);

        if (isset($validated['return_odometer_km']) && $validated['return_odometer_km'] < $validated['departure_odometer_km']) {
            return back()->withErrors(['return_odometer_km' => 'Return mileage cannot be lower than departure mileage.'])->withInput();
        }

        $distanceKm = 0;
        if (isset($validated['return_odometer_km'])) {
            $distanceKm = $validated['return_odometer_km'] - $validated['departure_odometer_km'];
        }
        $validated['distance_km'] = $distanceKm;

        // If completed/overdue, actual_return_at should be set.
        if (in_array($validated['status'], ['Completed', 'Overdue'], true) && empty($validated['actual_return_at'])) {
            $validated['actual_return_at'] = now();
        }

        $validated['updated_by'] = Auth::id();

        $vehicleTrip->update($validated);

        $this->storePassengers($vehicleTrip, $validated);

        return redirect()->route('vehicle_trips.index')->with('success', 'Vehicle trip updated successfully.');
    }

    public function destroy(VehicleTrip $vehicleTrip)
    {
        $vehicleTrip->delete();
        return redirect()->route('vehicle_trips.index')->with('success', 'Vehicle trip deleted successfully.');
    }

    private function storePassengers(VehicleTrip $trip, array $validated)
    {
        $staffCount = (int) ($validated['staff_count'] ?? 0);
        $attacheeCount = (int) ($validated['attachee_count'] ?? 0);
        $contractorCount = (int) ($validated['contractor_count'] ?? 0);
        $visitorCount = (int) ($validated['visitor_count'] ?? 0);

        $total = $staffCount + $attacheeCount + $contractorCount + $visitorCount;

        $payload = [
            'staff_count' => $staffCount,
            'attachee_count' => $attacheeCount,
            'contractor_count' => $contractorCount,
            'visitor_count' => $visitorCount,
            'total_occupants' => $total,
            'staff_names' => $validated['staff_names'] ?? null,
            'attachee_names' => $validated['attachee_names'] ?? null,
            'contractor_names' => $validated['contractor_names'] ?? null,
            'visitor_names' => $validated['visitor_names'] ?? null,
        ];

        $trip->passengers()->updateOrCreate(
            [],
            array_merge(['vehicle_trip_id' => $trip->id], $payload)
        );
    }
}

