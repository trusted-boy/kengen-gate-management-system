<x-app-layout>
    <x-slot name="header">
        <h1>Create Driver</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('drivers.store') }}">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}" required>
                                    @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Employee ID</label>
                                    <input type="text" name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" value="{{ old('employee_id') }}">
                                    @error('employee_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">License Number</label>
                                    <input type="text" name="license_number" class="form-control @error('license_number') is-invalid @enderror" value="{{ old('license_number') }}">
                                    @error('license_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">License Expiry</label>
                                    <input type="date" name="license_expiry_date" class="form-control @error('license_expiry_date') is-invalid @enderror" value="{{ old('license_expiry_date') }}">
                                    @error('license_expiry_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">License Category</label>
                                    <input type="text" name="license_category" class="form-control @error('license_category') is-invalid @enderror" value="{{ old('license_category') }}">
                                    @error('license_category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="">Select status...</option>
                                        <option value="Active" @selected(old('status')==='Active')>Active</option>
                                        <option value="Inactive" @selected(old('status')==='Inactive')>Inactive</option>
                                    </select>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label">Remarks</label>
                                    <textarea name="remarks" class="form-control @error('remarks') is-invalid @enderror" rows="2">{{ old('remarks') }}</textarea>
                                    @error('remarks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <hr class="mt-3" />

                                <div class="col-md-12">
                                    <label class="form-label">Assign Vehicles</label>
                                    <select name="vehicle_ids[]" class="form-select @error('vehicle_ids') is-invalid @enderror" multiple style="height: 200px;">
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ in_array($vehicle->id, old('vehicle_ids', [])) ? 'selected' : '' }}>
                                                {{ $vehicle->registration_number }} - {{ $vehicle->vehicle_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">Hold Ctrl (Windows) / Cmd (Mac) to select multiple.</div>
                                </div>

                                <div class="col-md-12 mt-2 d-flex gap-2">
                                    <button class="btn btn-success" type="submit"><i class="bi bi-save"></i> Save</button>
                                    <a href="{{ route('drivers.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

