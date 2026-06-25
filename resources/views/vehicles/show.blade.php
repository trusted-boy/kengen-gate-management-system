<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ $vehicle->registration_number }}</h1>
            <div>
                <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
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
                        <h6 class="mb-0">Vehicle Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Vehicle Type</h6>
                                <p class="fs-5">{{ $vehicle->vehicle_type }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Make/Model</h6>
                                <p class="fs-5">{{ $vehicle->make_model }} <span class="badge bg-secondary">{{ $vehicle->year }}</span></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Color</h6>
                                <p class="fs-5">{{ $vehicle->color ?: 'Not specified' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Status</h6>
                                <p class="fs-5">
                                    @if($vehicle->status === 'Active')
                                        <span class="badge badge-status badge-active">{{ $vehicle->status }}</span>
                                    @elseif($vehicle->status === 'Inactive')
                                        <span class="badge badge-status badge-inactive">{{ $vehicle->status }}</span>
                                    @else
                                        <span class="badge badge-status" style="background-color: #fff3cd; color: #856404;">{{ $vehicle->status }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Owner Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Owner Name</h6>
                                <p class="fs-5">{{ $vehicle->owner_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Owner Contact</h6>
                                <p class="fs-5">{{ $vehicle->owner_contact }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Driver Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Driver Name</h6>
                                <p class="fs-5">{{ $vehicle->driver_name ?: 'Not specified' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">License Number</h6>
                                <p class="fs-5">{{ $vehicle->driver_license_number ?: 'Not specified' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($vehicle->remarks)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Remarks</h6>
                        </div>
                        <div class="card-body">
                            <p>{{ $vehicle->remarks }}</p>
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
                            <p>{{ $vehicle->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Last Updated</h6>
                            <p>{{ $vehicle->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
