<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ $equipmentMovement->equipment_name }}</h1>
            <div>
                <a href="{{ route('equipment_movements.edit', $equipmentMovement) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('equipment_movements.index') }}" class="btn btn-secondary">
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
                        <h6 class="mb-0">Equipment Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Equipment Type</h6>
                                <p class="fs-5">{{ $equipmentMovement->equipment_type }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Status</h6>
                                <p class="fs-5">
                                    @if($equipmentMovement->status === 'Out')
                                        <span class="badge" style="background-color: #cfe2ff; color: #084298;">Out</span>
                                    @else
                                        <span class="badge badge-status badge-active">In</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        @if($equipmentMovement->description)
                            <div class="mb-3">
                                <h6 class="text-muted">Description</h6>
                                <p>{{ $equipmentMovement->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Transfer Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Owner</h6>
                                <p class="fs-5">{{ $equipmentMovement->owner_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Recipient</h6>
                                <p class="fs-5">{{ $equipmentMovement->recipient_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Movement Timeline</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Check Out Time</h6>
                                <p class="fs-5">{{ $equipmentMovement->check_out_time->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Check In Time</h6>
                                <p class="fs-5">{{ $equipmentMovement->check_in_time ? $equipmentMovement->check_in_time->format('M d, Y H:i') : 'Not yet returned' }}</p>
                            </div>
                        </div>

                        @if($equipmentMovement->check_in_time)
                            <div class="mb-3">
                                <h6 class="text-muted">Duration Outside</h6>
                                <p class="fs-5">{{ $equipmentMovement->check_in_time->diffForHumans($equipmentMovement->check_out_time) }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Purpose</h6>
                    </div>
                    <div class="card-body">
                        <p>{{ $equipmentMovement->purpose }}</p>
                    </div>
                </div>

                @if($equipmentMovement->remarks)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Remarks</h6>
                        </div>
                        <div class="card-body">
                            <p>{{ $equipmentMovement->remarks }}</p>
                        </div>
                    </div>
                @endif

                @if($equipmentMovement->authorizedBy)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Authorized By</h6>
                        </div>
                        <div class="card-body">
                            <p class="fs-5">{{ $equipmentMovement->authorizedBy->name }}</p>
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
                            <p>{{ $equipmentMovement->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Last Updated</h6>
                            <p>{{ $equipmentMovement->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
