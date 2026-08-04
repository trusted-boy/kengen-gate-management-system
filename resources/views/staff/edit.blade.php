<x-app-layout>
    <x-slot name="header">
        <h1>Edit Staff Record</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('staff.update', $staff) }}">
                            @csrf
                            @method('PUT')

                            <h6 class="mb-3 text-primary">Staff Information</h6>

                            <div class="mb-3">
                                <label for="staff_id" class="form-label">Staff ID <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('staff_id') is-invalid @enderror" id="staff_id" name="staff_id" value="{{ old('staff_id', $staff->staff_id) }}" required readonly>
                                @error('staff_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $staff->full_name) }}" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department', $staff->department) }}" required>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $staff->phone) }}" maxlength="20">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="vehicle_registration" class="form-label">Vehicle Registration</label>
                                <input type="text" class="form-control @error('vehicle_registration') is-invalid @enderror" id="vehicle_registration" name="vehicle_registration" value="{{ old('vehicle_registration', $staff->vehicle_registration) }}">
                                @error('vehicle_registration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6 class="mb-3 mt-4">Status</h6>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="IN" {{ old('status', $staff->status) === 'IN' ? 'selected' : '' }}>IN</option>
                                    <option value="OUT" {{ old('status', $staff->status) === 'OUT' ? 'selected' : '' }}>OUT</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Update Record
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
</x-app-layout>
