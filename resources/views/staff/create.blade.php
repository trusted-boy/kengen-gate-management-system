@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Staff Check In</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('staff.store') }}" method="POST">
                        @csrf

                        <!-- Staff ID with Auto-fill -->
                        <div class="mb-3">
                            <label for="staff_id" class="form-label">Staff ID *</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('staff_id') is-invalid @enderror" 
                                       id="staff_id" name="staff_id" value="{{ old('staff_id') }}" required
                                       placeholder="Enter staff ID">
                                <button class="btn btn-outline-secondary" type="button" id="autofill-btn">
                                    <i class="fas fa-sync"></i> Auto-fill
                                </button>
                            </div>
                            @error('staff_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <small class="text-muted">Enter an existing staff ID to auto-fill details</small>
                        </div>

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                   id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="mb-3">
                            <label for="department" class="form-label">Department *</label>
                            <input type="text" class="form-control @error('department') is-invalid @enderror" 
                                   id="department" name="department" value="{{ old('department') }}" required>
                            @error('department')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Vehicle Registration -->
                        <div class="mb-3">
                            <label for="vehicle_registration" class="form-label">Vehicle Registration (Optional)</label>
                            <input type="text" class="form-control @error('vehicle_registration') is-invalid @enderror" 
                                   id="vehicle_registration" name="vehicle_registration" value="{{ old('vehicle_registration') }}">
                            @error('vehicle_registration')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone (Optional)</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" maxlength="20">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Check In Staff
                            </button>
                            <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
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
@endsection
