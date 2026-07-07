<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ $internsAttachee->full_name }}</h1>
            <div>
                <a href="{{ route('interns_attachees.edit', $internsAttachee) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('interns_attachees.index') }}" class="btn btn-secondary">
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
                                <h6 class="text-muted">ID Number</h6>
                                <p class="fs-5">{{ $internsAttachee->id_number }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Phone</h6>
                                <p class="fs-5">{{ $internsAttachee->phone ?: 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Placement Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="text-muted">Institution / Organization</h6>
                            <p class="fs-5">{{ $internsAttachee->institution }}</p>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Department</h6>
                                <p class="fs-5">{{ $internsAttachee->department }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Purpose</h6>
                                <p class="fs-5">{{ $internsAttachee->purpose }}</p>
                            </div>
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
                                <p class="fs-5">{{ $internsAttachee->check_in_time->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Check Out Time</h6>
                                <p class="fs-5">{{ $internsAttachee->check_out_time ? $internsAttachee->check_out_time->format('M d, Y H:i') : 'Not yet checked out' }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Status</h6>
                            <p class="fs-5">
                                @if($internsAttachee->status === 'IN')
                                    <span class="badge bg-success">Present</span>
                                @else
                                    <span class="badge bg-secondary">Checked Out</span>
                                @endif
                            </p>
                        </div>

                        @if($internsAttachee->check_out_time)
                            <div class="mb-3">
                                <h6 class="text-muted">Duration of Stay</h6>
                                <p class="fs-5">{{ $internsAttachee->check_out_time->diff($internsAttachee->check_in_time)->format('%h hours %i minutes') }}</p>
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
                            <p>{{ $internsAttachee->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Last Updated</h6>
                            <p>{{ $internsAttachee->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
