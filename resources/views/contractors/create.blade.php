<x-app-layout>
    <x-slot name="header">
        <h1>Check In Contractor</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('contractors.store') }}">
                            @csrf

                            <h6 class="mb-3 text-primary">License Number with Auto-fill</h6>

                            <div class="mb-3">
                                <label for="license_number" class="form-label">License Number <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('license_number') is-invalid @enderror" id="license_number" name="license_number" value="{{ old('license_number') }}" placeholder="Enter license number" required>
                                    <button class="btn btn-outline-secondary" type="button" id="autofill-btn">
                                        <i class="bi bi-arrow-repeat"></i> Auto-fill
                                    </button>
                                </div>
                                @error('license_number')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Enter an existing license number to auto-fill contractor details</small>
                            </div>

                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="contact_person" class="form-label">Contact Person <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required>
                                    @error('contact_person')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="license_expiry" class="form-label">License Expiry <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('license_expiry') is-invalid @enderror" id="license_expiry" name="license_expiry" value="{{ old('license_expiry') }}" required>
                                @error('license_expiry')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="services_offered" class="form-label">Services Offered <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('services_offered') is-invalid @enderror" id="services_offered" name="services_offered" rows="3" placeholder="List services provided..." required>{{ old('services_offered') }}</textarea>
                                @error('services_offered')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">Select status...</option>
                                    <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="Expired" {{ old('status') == 'Expired' ? 'selected' : '' }}>Expired</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3" placeholder="Additional remarks...">{{ old('remarks') }}</textarea>
                                @error('remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Check In Contractor
                                </button>
                                <a href="{{ route('contractors.index') }}" class="btn btn-secondary">
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
        const licenseNo = document.getElementById('license_number').value;
        if (!licenseNo) {
            alert('Please enter a license number first');
            return;
        }

        fetch(`{{ route('api.contractor-details') }}?license_number=${encodeURIComponent(licenseNo)}`)
            .then(response => {
                if (!response.ok) throw new Error('Contractor not found');
                return response.json();
            })
            .then(data => {
                document.getElementById('company_name').value = data.company_name;
                document.getElementById('contact_person').value = data.contact_person;
                document.getElementById('email').value = data.email;
                document.getElementById('phone').value = data.phone;
                document.getElementById('license_expiry').value = data.license_expiry;
                document.getElementById('services_offered').value = data.services_offered;
                document.getElementById('status').value = data.status;
            })
            .catch(error => {
                alert('Contractor not found or error occurred');
                console.error(error);
            });
    });
    </script>
</x-app-layout>
