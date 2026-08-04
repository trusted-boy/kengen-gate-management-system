<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ $staff->full_name }}</h1>
            <div>
                <a href="{{ route('staff.edit', $staff) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('staff.index') }}" class="btn btn-secondary">
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
                                <h6 class="text-muted">Staff ID</h6>
                                <p class="fs-5">{{ $staff->staff_id }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Department</h6>
                                <p class="fs-5">{{ $staff->department }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Phone</h6>
                                <p class="fs-5">{{ $staff->phone ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Vehicle Registration</h6>
                                <p class="fs-5">{{ $staff->vehicle_registration ?? 'N/A' }}</p>
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
                                <p class="fs-5">{{ $staff->check_in_time->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Check Out Time</h6>
                                <p class="fs-5">{{ $staff->check_out_time ? $staff->check_out_time->format('M d, Y H:i') : 'Not yet checked out' }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Status</h6>
                            <p class="fs-5">
                                @if($staff->status === 'IN')
                                    <span class="badge bg-success">Inside</span>
                                @else
                                    <span class="badge bg-secondary">Outside</span>
                                @endif
                            </p>
                        </div>

                        @if($staff->formatted_duration)
                            <div class="mb-3">
                                <h6 class="text-muted">Duration of Stay</h6>
                                <p class="fs-5"><strong>{{ $staff->formatted_duration }}</strong></p>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($staff->status === 'IN')
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('staff.checkout', $staff) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning" onclick="return confirm('Check out this staff member?')">
                                    <i class="bi bi-sign-stop"></i> Check Out
                                </button>
                            </form>
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
                            <p>{{ $staff->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Last Updated</h6>
                            <p>{{ $staff->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
