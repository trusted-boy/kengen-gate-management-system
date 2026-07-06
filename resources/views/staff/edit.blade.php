@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Staff Record</h5>
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

                    <form action="{{ route('staff.update', $staff->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Staff ID -->
                        <div class="mb-3">
                            <label for="staff_id" class="form-label">Staff ID *</label>
                            <input type="text" class="form-control @error('staff_id') is-invalid @enderror" 
                                   id="staff_id" name="staff_id" value="{{ old('staff_id', $staff->staff_id) }}" required readonly>
                            @error('staff_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                   id="full_name" name="full_name" value="{{ old('full_name', $staff->full_name) }}" required>
                            @error('full_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="mb-3">
                            <label for="department" class="form-label">Department *</label>
                            <input type="text" class="form-control @error('department') is-invalid @enderror" 
                                   id="department" name="department" value="{{ old('department', $staff->department) }}" required>
                            @error('department')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Vehicle Registration -->
                        <div class="mb-3">
                            <label for="vehicle_registration" class="form-label">Vehicle Registration</label>
                            <input type="text" class="form-control @error('vehicle_registration') is-invalid @enderror" 
                                   id="vehicle_registration" name="vehicle_registration" 
                                   value="{{ old('vehicle_registration', $staff->vehicle_registration) }}">
                            @error('vehicle_registration')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $staff->phone) }}" maxlength="20">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="IN" {{ old('status', $staff->status) === 'IN' ? 'selected' : '' }}>IN</option>
                                <option value="OUT" {{ old('status', $staff->status) === 'OUT' ? 'selected' : '' }}>OUT</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Record
                            </button>
                            <a href="{{ route('staff.show', $staff->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
