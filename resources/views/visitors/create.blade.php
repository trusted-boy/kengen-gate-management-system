<x-app-layout>
    <x-slot name="header">
        <h1>Check In Visitor</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('visitors.store') }}">
                            @csrf

                            <h6 class="mb-3 text-primary">Personal Information with Auto-fill</h6>

                            <div class="mb-3">
                                <label for="id_number" class="form-label">National ID Number <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('id_number') is-invalid @enderror" id="id_number" name="id_number" value="{{ old('id_number') }}" placeholder="Enter ID number" required>
                                    <button class="btn btn-outline-secondary" type="button" id="autofill-btn">
                                        <i class="bi bi-arrow-repeat"></i> Auto-fill
                                    </button>
                                </div>
                                @error('id_number')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Enter an existing ID number to auto-fill visitor details</small>
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
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}" required>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="mb-3 mt-4">Visit Details</h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehicle_registration" class="form-label">Vehicle Registration (Optional)</label>
                                    <input type="text" class="form-control @error('vehicle_registration') is-invalid @enderror" id="vehicle_registration" name="vehicle_registration" value="{{ old('vehicle_registration') }}">
                                    @error('vehicle_registration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="number_of_visitors" class="form-label">Number of Visitors <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('number_of_visitors') is-invalid @enderror" id="number_of_visitors" name="number_of_visitors" value="{{ old('number_of_visitors', 1) }}" min="1" required>
                                    @error('number_of_visitors')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="reason_for_visit" class="form-label">Reason for Visit</label>
                                <input type="text" class="form-control @error('reason_for_visit') is-invalid @enderror" id="reason_for_visit" name="reason_for_visit" value="{{ old('reason_for_visit') }}" placeholder="E.g., Business Meeting, Delivery, Interview">
                                @error('reason_for_visit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="host_name" class="form-label">Host Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('host_name') is-invalid @enderror" id="host_name" name="host_name" value="{{ old('host_name') }}" required>
                                    @error('host_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="whom_to_see" class="form-label">Whom to See</label>
                                    <input type="text" class="form-control @error('whom_to_see') is-invalid @enderror" id="whom_to_see" name="whom_to_see" value="{{ old('whom_to_see') }}">
                                    @error('whom_to_see')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose of Visit <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="3" placeholder="Describe the purpose of this visit..." required>{{ old('purpose') }}</textarea>
                                @error('purpose')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Authorization section removed (signature disabled) --}}


                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Check In Visitor
                                </button>
                                <a href="{{ route('visitors.index') }}" class="btn btn-secondary">
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
        const idNum = document.getElementById('id_number').value;
        if (!idNum) {
            alert('Please enter an ID number first');
            return;
        }

        fetch(`{{ route('api.visitor-details') }}?id_number=${encodeURIComponent(idNum)}`)
            .then(response => {
                if (!response.ok) throw new Error('Visitor not found');
                return response.json();
            })
            .then(data => {
                document.getElementById('full_name').value = data.full_name;
                document.getElementById('phone').value = data.phone || '';
                document.getElementById('vehicle_registration').value = data.vehicle_registration || '';
                document.getElementById('department').value = data.department || '';
            })
            .catch(error => {
                alert('Visitor not found or error occurred');
                console.error(error);
            });
    });
    </script>
</x-app-layout>
