<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ $visitor->full_name }}</h1>
            <div>
                <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('visitors.index') }}" class="btn btn-secondary">
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
                        <h6 class="mb-0">Personal Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">National ID Number</h6>
                                <p class="fs-5">{{ $visitor->id_number }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Phone</h6>
                                <p class="fs-5">{{ $visitor->phone ?: 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Visit Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Host Name</h6>
                                <p class="fs-5">{{ $visitor->host_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Whom to See</h6>
                                <p class="fs-5">{{ $visitor->whom_to_see ?: 'Not specified' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Vehicle Registration</h6>
                                <p class="fs-5">{{ $visitor->vehicle_registration ?: '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Number of Visitors</h6>
                                <p class="fs-5">{{ $visitor->number_of_visitors }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Reason for Visit</h6>
                                <p class="fs-5">{{ $visitor->reason_for_visit ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Purpose</h6>
                            <p>{{ $visitor->purpose }}</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Access Log</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Check In Time</h6>
                                <p class="fs-5">{{ $visitor->check_in_time->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Check Out Time</h6>
                                <p class="fs-5">{{ $visitor->check_out_time ? $visitor->check_out_time->format('M d, Y H:i') : 'Not yet checked out' }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Status</h6>
                            <p class="fs-5">
                                @if($visitor->status === 'IN')
                                    <span class="badge bg-success">Inside</span>
                                @else
                                    <span class="badge bg-secondary">Outside</span>
                                @endif
                            </p>
                        </div>

                        @if($visitor->check_out_time)
                            <div class="mb-3">
                                <h6 class="text-muted">Duration of Stay</h6>
                                <p class="fs-5">{{ $visitor->check_out_time->diff($visitor->check_in_time)->format('%h hours %i minutes') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Additional Info</h6>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <h6 class="text-muted">Checked In</h6>
                            <p>{{ $visitor->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Last Updated</h6>
                            <p>{{ $visitor->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
