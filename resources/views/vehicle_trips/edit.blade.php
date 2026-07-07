<x-app-layout>
    <x-slot name="header">
        <div>
            <h1>Edit Vehicle Trip</h1>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('vehicle_trips.update', $vehicleTrip) }}">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Vehicle</label>
                                    <select name="vehicle_id" class="form-select" required>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" @selected($vehicleTrip->vehicle_id === $vehicle->id)>
                                                {{ $vehicle->registration_number }} - {{ $vehicle->vehicle_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Driver</label>
                                    <select name="driver_id" class="form-select" required>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" @selected($vehicleTrip->driver_id === $driver->id)>
                                                {{ $driver->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Departure Gate</label>
                                    <input type="text" name="departure_gate" class="form-control" value="{{ $vehicleTrip->departure_gate }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Return Gate</label>
                                    <input type="text" name="return_gate" class="form-control" value="{{ $vehicleTrip->return_gate }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        @foreach(['Active','Completed','Overdue'] as $st)
                                            <option value="{{ $st }}" @selected($vehicleTrip->status === $st)>{{ $st }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Destination</label>
                                    <input type="text" name="destination" class="form-control" value="{{ $vehicleTrip->destination }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Purpose of Trip</label>
                                    <input type="text" name="purpose_of_trip" class="form-control" value="{{ $vehicleTrip->purpose_of_trip }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Departure Date & Time</label>
                                    <input type="datetime-local" name="departure_at" class="form-control" value="{{ $vehicleTrip->departure_at ? $vehicleTrip->departure_at->format('Y-m-d\TH:i') : '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Expected Return Time</label>
                                    <input type="datetime-local" name="expected_return_at" class="form-control" value="{{ $vehicleTrip->expected_return_at ? $vehicleTrip->expected_return_at->format('Y-m-d\TH:i') : '' }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Actual Return At (optional)</label>
                                    <input type="datetime-local" name="actual_return_at" class="form-control" value="{{ $vehicleTrip->actual_return_at ? $vehicleTrip->actual_return_at->format('Y-m-d\TH:i') : '' }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Departure Odometer (km)</label>
                                    <input type="number" name="departure_odometer_km" class="form-control" value="{{ $vehicleTrip->departure_odometer_km }}" required min="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Return Odometer (km)</label>
                                    <input type="number" name="return_odometer_km" class="form-control" value="{{ $vehicleTrip->return_odometer_km }}" min="0">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Remarks (abnormal mileage)</label>
                                    <textarea name="remarks" class="form-control" rows="3">{{ $vehicleTrip->remarks }}</textarea>
                                </div>

                                <hr class="mt-4"/>

                                @php($p = $vehicleTrip->passengers)
                                <div class="col-md-3">
                                    <label class="form-label">Staff</label>
                                    <input type="number" name="staff_count" class="form-control" min="0" value="{{ $p->staff_count ?? 0 }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Attachés</label>
                                    <input type="number" name="attachee_count" class="form-control" min="0" value="{{ $p->attachee_count ?? 0 }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Contractors</label>
                                    <input type="number" name="contractor_count" class="form-control" min="0" value="{{ $p->contractor_count ?? 0 }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Visitors</label>
                                    <input type="number" name="visitor_count" class="form-control" min="0" value="{{ $p->visitor_count ?? 0 }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Staff Names (CSV)</label>
                                    <input type="text" name="staff_names" class="form-control" value="{{ $p->staff_names ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Attaché Names (CSV)</label>
                                    <input type="text" name="attachee_names" class="form-control" value="{{ $p->attachee_names ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contractor Names (CSV)</label>
                                    <input type="text" name="contractor_names" class="form-control" value="{{ $p->contractor_names ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Visitor Names (CSV)</label>
                                    <input type="text" name="visitor_names" class="form-control" value="{{ $p->visitor_names ?? '' }}">
                                </div>

                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-save"></i> Update Trip
                                    </button>
                                    <a href="{{ route('vehicle_trips.index') }}" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

