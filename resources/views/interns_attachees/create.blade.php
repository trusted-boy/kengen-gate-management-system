<x-app-layout>
    <x-slot name="header">
        <h1>Check In Intern/Attachee</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('interns_attachees.store') }}">
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
                                <small class="text-muted">Enter an existing ID number to auto-fill intern/attachee details</small>
                            </div>

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6 class="mb-3 mt-4">Placement Details</h6>

                            <div class="mb-3">
                                <label for="institution" class="form-label">Institution / Organization <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('institution') is-invalid @enderror" id="institution" name="institution" value="{{ old('institution') }}" placeholder="School/University/Company" required>
                                @error('institution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label">Department Attached To <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}" required>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="purpose" class="form-label">Purpose <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" value="{{ old('purpose') }}" placeholder="Internship/Attachment/Research" required>
                                    @error('purpose')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Authorization section removed (signature disabled) --}}


                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Check In
                                </button>
                                <a href="{{ route('interns_attachees.index') }}" class="btn btn-secondary">
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

        fetch(`{{ route('api.interns-details') }}?id_number=${encodeURIComponent(idNum)}`)
            .then(response => {
                if (!response.ok) throw new Error('Intern/Attachee not found');
                return response.json();
            })
            .then(data => {
                document.getElementById('full_name').value = data.full_name;
                document.getElementById('phone').value = data.phone || '';
                document.getElementById('institution').value = data.institution || '';
                document.getElementById('department').value = data.department || '';
            })
            .catch(error => {
                alert('Intern/Attachee not found or error occurred');
                console.error(error);
            });
    });
    </script>
</x-app-layout>
