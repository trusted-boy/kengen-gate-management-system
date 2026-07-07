<x-app-layout>
    <x-slot name="header">
        <h1>Edit Visitor Record</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('visitors.update', $visitor) }}">
                            @csrf
                            @method('PATCH')

                            <h6 class="mb-3">Personal Information</h6>

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $visitor->full_name) }}" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="id_number" class="form-label">National ID Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('id_number') is-invalid @enderror" id="id_number" name="id_number" value="{{ old('id_number', $visitor->id_number) }}" required>
                                    @error('id_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $visitor->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="mb-3 mt-4">Visit Details</h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehicle_registration" class="form-label">Vehicle Registration (Optional)</label>
                                    <input type="text" class="form-control @error('vehicle_registration') is-invalid @enderror" id="vehicle_registration" name="vehicle_registration" value="{{ old('vehicle_registration', $visitor->vehicle_registration) }}">
                                    @error('vehicle_registration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="number_of_visitors" class="form-label">Number of Visitors <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('number_of_visitors') is-invalid @enderror" id="number_of_visitors" name="number_of_visitors" value="{{ old('number_of_visitors', $visitor->number_of_visitors) }}" min="1" required>
                                    @error('number_of_visitors')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="reason_for_visit" class="form-label">Reason for Visit</label>
                                <input type="text" class="form-control @error('reason_for_visit') is-invalid @enderror" id="reason_for_visit" name="reason_for_visit" value="{{ old('reason_for_visit', $visitor->reason_for_visit) }}">
                                @error('reason_for_visit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="host_name" class="form-label">Host Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('host_name') is-invalid @enderror" id="host_name" name="host_name" value="{{ old('host_name', $visitor->host_name) }}" required>
                                    @error('host_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="whom_to_see" class="form-label">Whom to See</label>
                                    <input type="text" class="form-control @error('whom_to_see') is-invalid @enderror" id="whom_to_see" name="whom_to_see" value="{{ old('whom_to_see', $visitor->whom_to_see) }}">
                                    @error('whom_to_see')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose of Visit <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="3" required>{{ old('purpose', $visitor->purpose) }}</textarea>
                                @error('purpose')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6 class="mb-3 mt-4">Status</h6>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="IN" {{ old('status', $visitor->status) == 'IN' ? 'selected' : '' }}>Inside</option>
                                    <option value="OUT" {{ old('status', $visitor->status) == 'OUT' ? 'selected' : '' }}>Outside</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Authorization section removed (signature disabled) --}}


                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Update Visitor
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
</x-app-layout>
