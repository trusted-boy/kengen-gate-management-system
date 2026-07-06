<x-app-layout>
    <x-slot name="header">
        <h1>Check In Vehicle</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('vehicles.store') }}">
                            @csrf

                            <h6 class="mb-3 text-primary">Registration Number with Auto-fill</h6>

                            <div class="mb-3">
                                <label for="registration_number" class="form-label">Registration Number <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('registration_number') is-invalid @enderror" id="registration_number" name="registration_number" value="{{ old('registration_number') }}" placeholder="Enter registration number" required>
                                    <button class="btn btn-outline-secondary" type="button" id="autofill-btn">
                                        <i class="bi bi-arrow-repeat"></i> Auto-fill
                                    </button>
                                </div>
                                @error('registration_number')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Enter an existing registration number to auto-fill vehicle details</small>
                            </div>

                            <h6 class="mb-3 text-primary">Vehicle Information</h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehicle_type" class="form-label">Vehicle Type <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('vehicle_type') is-invalid @enderror" id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type') }}" placeholder="e.g., Car, Truck, Bus" required>
                                    @error('vehicle_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="make_model" class="form-label">Make/Model <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('make_model') is-invalid @enderror" id="make_model" name="make_model" value="{{ old('make_model') }}" required>
                                    @error('make_model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}" min="1900" max="{{ date('Y') }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color') }}">
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="">Select status...</option>
                                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="Under Maintenance" {{ old('status') == 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <h6 class="mb-3 text-primary">Owner Information</h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="owner_name" class="form-label">Owner Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('owner_name') is-invalid @enderror" id="owner_name" name="owner_name" value="{{ old('owner_name') }}" required>
                                    @error('owner_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="owner_contact" class="form-label">Owner Contact <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('owner_contact') is-invalid @enderror" id="owner_contact" name="owner_contact" value="{{ old('owner_contact') }}" required>
                                    @error('owner_contact')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <h6 class="mb-3 text-primary">Driver Information</h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="driver_name" class="form-label">Driver Name</label>
                                    <input type="text" class="form-control @error('driver_name') is-invalid @enderror" id="driver_name" name="driver_name" value="{{ old('driver_name') }}">
                                    @error('driver_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="driver_license_number" class="form-label">Driver License Number</label>
                                    <input type="text" class="form-control @error('driver_license_number') is-invalid @enderror" id="driver_license_number" name="driver_license_number" value="{{ old('driver_license_number') }}">
                                    @error('driver_license_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3" placeholder="Any additional remarks...">{{ old('remarks') }}</textarea>
                                @error('remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Check In Vehicle
                                </button>
                                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('autofill-btn').addEventListener('click', function() {
        const regNo = document.getElementById('registration_number').value;
        if (!regNo) {
            alert('Please enter a registration number first');
            return;
        }

        fetch(`{{ route('api.vehicle-details') }}?registration_number=${encodeURIComponent(regNo)}`)
            .then(response => {
                if (!response.ok) throw new Error('Vehicle not found');
                return response.json();
            })
            .then(data => {
                document.getElementById('vehicle_type').value = data.vehicle_type;
                document.getElementById('make_model').value = data.make_model;
                document.getElementById('year').value = data.year;
                document.getElementById('color').value = data.color || '';
                document.getElementById('owner_name').value = data.owner_name;
                document.getElementById('owner_contact').value = data.owner_contact;
                document.getElementById('driver_name').value = data.driver_name || '';
                document.getElementById('driver_license_number').value = data.driver_license_number || '';
                document.getElementById('status').value = data.status;
            })
            .catch(error => {
                alert('Vehicle not found or error occurred');
                console.error(error);
            });
    });
    </script>
</x-app-layout>
