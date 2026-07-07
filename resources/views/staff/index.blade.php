@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2">Staff Gate Register</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('staff.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Check In Staff
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search by staff ID, name, phone, or department..." value="{{ $search }}">
                </div>
                <div class="col-md-3">
                    <select name="per_page" class="form-select">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 per page</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 per page</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 per page</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 per page</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Staff Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Staff ID</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Vehicle Reg.</th>
                        <th>Check-In Time</th>
                        <th>Check-Out Time</th>
                        <th>Duration</th>
                        <th>Current Status (IN / OUT)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($staff as $member)
                        <tr>
                            <td><strong>{{ $member->staff_id }}</strong></td>
                            <td>{{ $member->full_name }}</td>
                            <td>{{ $member->department }}</td>
                            <td>{{ $member->phone ?? 'N/A' }}</td>
                            <td>{{ $member->vehicle_registration ?? 'N/A' }}</td>
                            <td>{{ $member->check_in_time_formatted }}</td>
                            <td>
                                @if ($member->status === 'IN')
                                    <span class="badge bg-success">Still Inside</span>
                                @else
                                    {{ $member->check_out_time_formatted }}
                                @endif
                            </td>
                            <td>{{ $member->stay_duration_human ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $member->status === 'IN' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $member->status }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('staff.show', $member->id) }}" class="btn btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if ($member->status === 'IN')
                                        <form action="{{ route('staff.checkout', $member->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning" title="Check Out">
                                                <i class="fas fa-sign-out-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('staff.edit', $member->id) }}" class="btn btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('staff.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">
                                No staff records found. <a href="{{ route('staff.create') }}">Check in staff</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $staff->links() }}
    </div>
</div>
@endsection
