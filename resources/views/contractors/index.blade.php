<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Contractor Gate Register</h1>
            <a href="{{ route('contractors.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Check In Contractor
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('contractors.index') }}" class="row g-3">
                            <div class="col-md-9">
                                <input type="text" name="search" class="form-control" placeholder="Search by company name, contact person, license number, or phone..." value="{{ $search }}">
                            </div>
                            <div class="col-md-3">
                                <select name="per_page" class="form-select" onchange="this.form.submit()">
                                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 per page</option>
                                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 per page</option>
                                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 per page</option>
                                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 per page</option>
                                </select>
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
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Check-In Time</th>
                                    <th>Check-Out Time</th>
                                    <th>Duration</th>
                                    <th>Current Status (IN / OUT)</th>
                                    <th style="width: 200px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contractors as $contractor)
                                    <tr>
                                        <td>{{ $loop->iteration + ($contractors->currentPage() - 1) * $contractors->perPage() }}</td>
                                        <td><strong>{{ $contractor->company_name }}</strong></td>
                                        <td>{{ $contractor->contact_person }}</td>
                                        <td>{{ $contractor->phone }}</td>
                                        <td>{{ $contractor->check_in_time_formatted }}</td>
                                        <td>
                                            @if(($contractor->visit_status ?? 'OUT') === 'IN')
                                                <span class="badge bg-success">Still Inside</span>
                                            @else
                                                {{ $contractor->check_out_time_formatted }}
                                            @endif
                                        </td>
                                        <td>{{ $contractor->stay_duration_human ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ ($contractor->visit_status ?? 'OUT') === 'IN' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ($contractor->visit_status ?? 'OUT') === 'IN' ? 'IN' : 'OUT' }}
                                            </span>
                                        </td>

                                        <td>
                                            <a href="{{ route('contractors.show', $contractor) }}" class="btn btn-sm btn-info btn-action" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if (($contractor->visit_status ?? 'OUT') === 'IN')
                                                <form action="{{ route('contractors.checkout', $contractor->id) }}" method="POST" class="d-inline" title="Check Out">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning btn-action">
                                                        <i class="bi bi-sign-stop"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('contractors.edit', $contractor) }}" class="btn btn-sm btn-primary btn-action" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" action="{{ route('contractors.destroy', $contractor) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                            No contractors found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $contractors->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
