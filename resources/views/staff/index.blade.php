<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Staff Gate Register</h1>
            <a href="{{ route('staff.create') }}" class="btn btn-primary">
                <i class="bi bi-person-badge"></i> Check In Staff
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Search Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('staff.index') }}" class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search by staff ID, name, phone, or department..." value="{{ $search }}">
                            </div>
                            <div class="col-md-3">
                                <select name="per_page" class="form-select" onchange="this.form.submit()">
                                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 per page</option>
                                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 per page</option>
                                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 per page</option>
                                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 per page</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Staff Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Staff ID</th>
                                    <th>Full Name</th>
                                    <th>Department</th>
                                    <th>Phone</th>
                                    <th>Vehicle Reg.</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th style="width: 200px;">Actions</th>
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
                                        <td>{{ $member->check_in_time->format('Y-m-d H:i') }}</td>
                                        <td>{{ $member->check_out_time ? $member->check_out_time->format('Y-m-d H:i') : '-' }}</td>
                                        <td>
                                            @if ($member->formatted_duration)
                                                {{ $member->formatted_duration }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($member->status === 'IN')
                                                <span class="badge bg-success">Inside</span>
                                            @else
                                                <span class="badge bg-secondary">Outside</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('staff.show', $member) }}" class="btn btn-sm btn-info btn-action" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if ($member->status === 'IN')
                                                <form action="{{ route('staff.checkout', $member) }}" method="POST" class="d-inline" title="Check Out">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success btn-action" onclick="return confirm('Check out this staff member?')">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('staff.edit', $member) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('staff.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-action" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            No staff records found. <a href="{{ route('staff.create') }}">Check in staff</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $staff->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
