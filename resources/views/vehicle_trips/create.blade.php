<x-app-layout>
    <x-slot name="header">
        <div>
            <h1>Create Vehicle Trip</h1>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('vehicle_trips.store') }}">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Vehicle</label>
                                    <select name="vehicle_id" class="form-select @error('vehicle_id') is-invalid @enderror" required>
                                        <option value="">Select vehicle</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" @selected(old('vehicle_id') == $vehicle->id)>
                                                {{ $vehicle->registration_number }} - {{ $vehicle->vehicle_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Driver</label>
                                    <select name="driver_id" class="form-select @error('driver_id') is-invalid @enderror" required>
                                        <option value="">Select driver</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" @selected(old('driver_id') == $driver->id)>
                                                {{ $driver->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('driver_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Departure Gate</label>
                                    <input type="text" name="departure_gate" class="form-control @error('departure_gate') is-invalid @enderror" value="{{ old('departure_gate') }}" required>
                                    @error('departure_gate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Return Gate</label>
                                    <input type="text" name="return_gate" class="form-control @error('return_gate') is-invalid @enderror" value="{{ old('return_gate') }}" required>
                                    @error('return_gate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="Active" @selected(old('status','Active') === 'Active')>Active</option>
                                        <option value="Completed" @selected(old('status') === 'Completed')>Completed</option>
                                        <option value="Overdue" @selected(old('status') === 'Overdue')>Overdue</option>
                                    </select>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Destination</label>
                                    <input type="text" name="destination" class="form-control @error('destination') is-invalid @enderror" value="{{ old('destination') }}" required>
                                    @error('destination')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Purpose of Trip</label>
                                    <input type="text" name="purpose_of_trip" class="form-control @error('purpose_of_trip') is-invalid @enderror" value="{{ old('purpose_of_trip') }}" required>
                                    @error('purpose_of_trip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Departure Date & Time</label>
                                    <input type="datetime-local" name="departure_at" class="form-control @error('departure_at') is-invalid @enderror" value="{{ old('departure_at') }}" required>
                                    @error('departure_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Expected Return Time</label>
                                    <input type="datetime-local" name="expected_return_at" class="form-control @error('expected_return_at') is-invalid @enderror" value="{{ old('expected_return_at') }}" required>
                                    @error('expected_return_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Departure Odometer (km)</label>
                                    <input type="number" name="departure_odometer_km" class="form-control @error('departure_odometer_km') is-invalid @enderror" value="{{ old('departure_odometer_km') }}" required min="0">
                                    @error('departure_odometer_km')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Return Odometer (km) (optional)</label>
                                    <input type="number" name="return_odometer_km" class="form-control @error('return_odometer_km') is-invalid @enderror" value="{{ old('return_odometer_km') }}" min="0">
                                    @error('return_odometer_km')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <div class="form-text">Distance will be auto-calculated and stored.</div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Remarks (for abnormal mileage)</label>
                                    <textarea name="remarks" class="form-control @error('remarks') is-invalid @enderror" rows="3">{{ old('remarks') }}</textarea>
                                    @error('remarks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <hr class="mt-4"/>

                                <div class="col-md-3">
                                    <label class="form-label">Staff</label>
                                    <input type="number" name="staff_count" class="form-control" min="0" value="{{ old('staff_count', 0) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Attachés</label>
                                    <input type="number" name="attachee_count" class="form-control" min="0" value="{{ old('attachee_count', 0) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Contractors</label>
                                    <input type="number" name="contractor_count" class="form-control" min="0" value="{{ old('contractor_count', 0) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Visitors</label>
                                    <input type="number" name="visitor_count" class="form-control" min="0" value="{{ old('visitor_count', 0) }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Staff Names (optional CSV)</label>
                                    <input type="text" name="staff_names" class="form-control" value="{{ old('staff_names') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Attaché Names (optional CSV)</label>
                                    <input type="text" name="attachee_names" class="form-control" value="{{ old('attachee_names') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contractor Names (optional CSV)</label>
                                    <input type="text" name="contractor_names" class="form-control" value="{{ old('contractor_names') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Visitor Names (optional CSV)</label>
                                    <input type="text" name="visitor_names" class="form-control" value="{{ old('visitor_names') }}">
                                </div>

                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-save"></i> Save Trip
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

