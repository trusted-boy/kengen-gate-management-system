@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Staff Details</h5>
                        <div>
                            <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('staff.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Staff ID</h6>
                            <p>{{ $staff->staff_id }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Full Name</h6>
                            <p>{{ $staff->full_name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Department</h6>
                            <p>{{ $staff->department }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Phone</h6>
                            <p>{{ $staff->phone ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Vehicle Registration</h6>
                            <p>{{ $staff->vehicle_registration ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Status</h6>
                            <p>
                                <span class="badge {{ $staff->status === 'IN' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $staff->status }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Time In</h6>
                            <p>{{ $staff->check_in_time->format('Y-m-d H:i:s') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Time Out</h6>
                            <p>{{ $staff->check_out_time ? $staff->check_out_time->format('Y-m-d H:i:s') : 'Not checked out' }}</p>
                        </div>
                    </div>

                    @if ($staff->formatted_duration)
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h6 class="text-muted">Duration of Stay</h6>
                                <p><strong>{{ $staff->formatted_duration }}</strong></p>
                            </div>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h6 class="text-muted">Created At</h6>
                            <p>{{ $staff->created_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>

                    @if ($staff->status === 'IN')
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('staff.checkout', $staff->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-sign-out-alt"></i> Check Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
