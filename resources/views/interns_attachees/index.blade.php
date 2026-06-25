<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Interns & Attachees Register</h1>
            <a href="{{ route('interns_attachees.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New Intern/Attachee
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('interns_attachees.index') }}" class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search by name, ID, institution, or department..." value="{{ request('search', '') }}">
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
                                    <th>Institution</th>
                                    <th>Department</th>
                                    <th>Check In</th>
                                    <th>Status</th>
                                    <th style="width: 180px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($interns as $intern)
                                    <tr>
                                        <td>{{ $loop->iteration + ($interns->currentPage() - 1) * $interns->perPage() }}</td>
                                        <td><strong>{{ $intern->full_name }}</strong></td>
                                        <td><small>{{ $intern->id_number }}</small></td>
                                        <td><small>{{ $intern->institution }}</small></td>
                                        <td><small>{{ $intern->department }}</small></td>
                                        <td>{{ $intern->check_in_time->format('M d, H:i') }}</td>
                                        <td>
                                            @if($intern->status === 'IN')
                                                <span class="badge bg-success">Present</span>
                                            @else
                                                <span class="badge bg-secondary">Checked Out</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('interns_attachees.show', $intern) }}" class="btn btn-sm btn-info btn-action" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($intern->status === 'IN')
                                                <form method="POST" action="{{ route('interns_attachees.checkout', $intern) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success btn-action" title="Check Out" onclick="return confirm('Check out this person?')">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('interns_attachees.edit', $intern) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" action="{{ route('interns_attachees.destroy', $intern) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                        <td colspan="8" class="text-center text-muted py-4">
                                            No interns/attachees found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $interns->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
