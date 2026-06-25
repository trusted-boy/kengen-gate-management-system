<x-app-layout>
    <x-slot name="header">
        <h1>Check Out Equipment</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('equipment_movements.store') }}">
                            @csrf

                            <h6 class="mb-3 text-primary">Equipment Details</h6>

                            <div class="mb-3">
                                <label for="equipment_name" class="form-label">Equipment Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('equipment_name') is-invalid @enderror" id="equipment_name" name="equipment_name" value="{{ old('equipment_name') }}" required>
                                @error('equipment_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="equipment_type" class="form-label">Equipment Type <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('equipment_type') is-invalid @enderror" id="equipment_type" name="equipment_type" value="{{ old('equipment_type') }}" placeholder="e.g., Tools, Machinery, Software" required>
                                    @error('equipment_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" placeholder="Equipment description...">
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <h6 class="mb-3 text-primary">Transfer Information</h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="owner_name" class="form-label">Owner Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('owner_name') is-invalid @enderror" id="owner_name" name="owner_name" value="{{ old('owner_name') }}" required>
                                    @error('owner_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="recipient_name" class="form-label">Recipient Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('recipient_name') is-invalid @enderror" id="recipient_name" name="recipient_name" value="{{ old('recipient_name') }}" required>
                                    @error('recipient_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="check_out_time" class="form-label">Check Out Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('check_out_time') is-invalid @enderror" id="check_out_time" name="check_out_time" value="{{ old('check_out_time', now()->format('Y-m-d H:i')) }}" required>
                                @error('check_out_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="3" placeholder="Purpose of equipment movement..." required>{{ old('purpose') }}</textarea>
                                @error('purpose')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="2" placeholder="Additional remarks...">{{ old('remarks') }}</textarea>
                                @error('remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Check Out Equipment
                                </button>
                                <a href="{{ route('equipment_movements.index') }}" class="btn btn-secondary">
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
