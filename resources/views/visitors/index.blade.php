<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Visitor Register</h1>
            <a href="{{ route('visitors.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New Visitor
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('visitors.index') }}" class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search by name, ID, vehicle, or host..." value="{{ request('search', '') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="per_page" class="form-select" onchange="this.form.submit()">
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page</option>
                                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25 per page</option>
                                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 per page</option>
                                    <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100 per page</option>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>ID Number</th>
                                    <th>Host / Dept</th>
                                    <th>Vehicle</th>
                                    <th>No. Visitors</th>
                                    <th>Check-In Time</th>
                                    <th>Check-Out Time</th>
                                    <th>Duration</th>
                                    <th>Current Status (IN / OUT)</th>
                                    <th style="width: 180px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($visitors as $visitor)
                                    <tr>
                                        <td>{{ $loop->iteration + ($visitors->currentPage() - 1) * $visitors->perPage() }}</td>
                                        <td><strong>{{ $visitor->full_name }}</strong></td>
                                        <td><small>{{ $visitor->id_number }}</small></td>
                                        <td>
                                            <small>{{ $visitor->host_name }}</small><br>
                                            <small class="text-muted">{{ $visitor->whom_to_see }}</small>
                                        </td>
                                        <td><small>{{ $visitor->vehicle_registration ?: '-' }}</small></td>
                                        <td><small>{{ $visitor->number_of_visitors }}</small></td>
                                        <td>{{ $visitor->check_in_time_formatted }}</td>
                                        <td>
                                            @if($visitor->status === 'IN')
                                                <span class="badge bg-success">Still Inside</span>
                                            @else
                                                {{ $visitor->check_out_time_formatted }}
                                            @endif
                                        </td>
                                        <td>{{ $visitor->stay_duration_human ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $visitor->status === 'IN' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $visitor->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('visitors.show', $visitor) }}" class="btn btn-sm btn-info btn-action" title="View">


                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($visitor->status === 'IN')
                                                <form method="POST" action="{{ route('visitors.checkout', $visitor) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success btn-action" title="Check Out" onclick="return confirm('Check out this visitor?')">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" action="{{ route('visitors.destroy', $visitor) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                        <td colspan="9" class="text-center text-muted py-4">
                                            No visitors found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $visitors->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
