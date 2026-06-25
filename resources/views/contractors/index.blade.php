<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Contractor Management</h1>
            <a href="{{ route('contractors.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Contractor
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
                                <input type="text" name="search" class="form-control" placeholder="Search by company name, contact person, or license number..." value="{{ $search }}">
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
                                    <th>License Expiry</th>
                                    <th>Status</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contractors as $contractor)
                                    <tr>
                                        <td>{{ $loop->iteration + ($contractors->currentPage() - 1) * $contractors->perPage() }}</td>
                                        <td><strong>{{ $contractor->company_name }}</strong></td>
                                        <td>{{ $contractor->contact_person }}</td>
                                        <td>{{ $contractor->phone }}</td>
                                        <td>{{ $contractor->license_expiry->format('M d, Y') }}</td>
                                        <td>
                                            @if($contractor->status === 'Active')
                                                <span class="badge badge-status badge-active">{{ $contractor->status }}</span>
                                            @elseif($contractor->status === 'Expired')
                                                <span class="badge badge-status badge-inactive">{{ $contractor->status }}</span>
                                            @else
                                                <span class="badge badge-status" style="background-color: #f8d7da; color: #721c24;">{{ $contractor->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('contractors.show', $contractor) }}" class="btn btn-sm btn-info btn-action" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('contractors.edit', $contractor) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
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
                                        <td colspan="7" class="text-center text-muted py-4">
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
