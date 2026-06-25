<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ $contractor->company_name }}</h1>
            <div>
                <a href="{{ route('contractors.edit', $contractor) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('contractors.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Company Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Contact Person</h6>
                                <p class="fs-5">{{ $contractor->contact_person }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Phone</h6>
                                <p class="fs-5">{{ $contractor->phone }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Email</h6>
                                <p class="fs-5"><a href="mailto:{{ $contractor->email }}">{{ $contractor->email }}</a></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Status</h6>
                                <p class="fs-5">
                                    @if($contractor->status === 'Active')
                                        <span class="badge badge-status badge-active">{{ $contractor->status }}</span>
                                    @elseif($contractor->status === 'Expired')
                                        <span class="badge badge-status badge-inactive">{{ $contractor->status }}</span>
                                    @else
                                        <span class="badge badge-status" style="background-color: #f8d7da; color: #721c24;">{{ $contractor->status }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">License Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">License Number</h6>
                                <p class="fs-5">{{ $contractor->license_number }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">License Expiry</h6>
                                <p class="fs-5">
                                    {{ $contractor->license_expiry->format('M d, Y') }}
                                    @if($contractor->license_expiry < now())
                                        <span class="badge bg-danger ms-2">Expired</span>
                                    @elseif($contractor->license_expiry < now()->addDays(30))
                                        <span class="badge bg-warning ms-2">Expiring Soon</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Services Offered</h6>
                    </div>
                    <div class="card-body">
                        <p>{{ $contractor->services_offered }}</p>
                    </div>
                </div>

                @if($contractor->remarks)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Remarks</h6>
                        </div>
                        <div class="card-body">
                            <p>{{ $contractor->remarks }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Additional Info</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="text-muted">Created</h6>
                            <p>{{ $contractor->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Last Updated</h6>
                            <p>{{ $contractor->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
