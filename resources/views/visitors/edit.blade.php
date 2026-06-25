<x-app-layout>
    <x-slot name="header">
        <h1>Edit Visitor</h1>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('visitors.update', $visitor) }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $visitor->full_name) }}" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="id_number" class="form-label">ID Number <span class="text-danger">*</span></label>
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

                            <div class="mb-3">
                                <label for="organization" class="form-label">Organization</label>
                                <input type="text" class="form-control @error('organization') is-invalid @enderror" id="organization" name="organization" value="{{ old('organization', $visitor->organization) }}">
                                @error('organization')
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
                                    <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department', $visitor->department) }}" required>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose of Visit <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="4" required>{{ old('purpose', $visitor->purpose) }}</textarea>
                                @error('purpose')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

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
