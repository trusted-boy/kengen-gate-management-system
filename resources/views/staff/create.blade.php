<x-app-layout>
    <x-slot name="header">
        <h1>Staff Check In</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('staff.store') }}">
                            @csrf

                            <h6 class="mb-3 text-primary">Staff ID with Auto-fill</h6>

                            <div class="mb-3">
                                <label for="staff_id" class="form-label">Staff ID <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('staff_id') is-invalid @enderror" id="staff_id" name="staff_id" value="{{ old('staff_id') }}" placeholder="Enter staff ID" required>
                                    <button class="btn btn-outline-secondary" type="button" id="autofill-btn">
                                        <i class="bi bi-arrow-repeat"></i> Auto-fill
                                    </button>
                                </div>
                                @error('staff_id')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Enter an existing staff ID to auto-fill details</small>
                            </div>

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}" required>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" maxlength="20">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="vehicle_registration" class="form-label">Vehicle Registration (Optional)</label>
                                <input type="text" class="form-control @error('vehicle_registration') is-invalid @enderror" id="vehicle_registration" name="vehicle_registration" value="{{ old('vehicle_registration') }}">
                                @error('vehicle_registration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Check In Staff
                                </button>
                                <a href="{{ route('staff.index') }}" class="btn btn-secondary">
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
        const staffId = document.getElementById('staff_id').value;
        if (!staffId) {
            alert('Please enter a Staff ID first');
            return;
        }

        fetch(`{{ route('api.staff-details') }}?staff_id=${encodeURIComponent(staffId)}`)
            .then(response => {
                if (!response.ok) throw new Error('Staff not found');
                return response.json();
            })
            .then(data => {
                document.getElementById('full_name').value = data.full_name;
                document.getElementById('department').value = data.department;
                document.getElementById('vehicle_registration').value = data.vehicle_registration || '';
                document.getElementById('phone').value = data.phone || '';
            })
            .catch(error => {
                alert('Staff not found or error occurred');
                console.error(error);
            });
    });
    </script>
</x-app-layout>
