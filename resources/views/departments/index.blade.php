<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Departments</h1>
            <a href="{{ route('departments.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Department
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('departments.index') }}" class="row g-3">
                            <div class="col-md-9">
                                <input type="text" name="search" class="form-control" placeholder="Search by name or code..." value="{{ $search }}">
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
                                    <th>Department Name</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($departments as $department)
                                    <tr>
                                        <td>{{ $loop->iteration + ($departments->currentPage() - 1) * $departments->perPage() }}</td>
                                        <td><strong>{{ $department->name }}</strong></td>
                                        <td><span class="badge bg-secondary">{{ $department->code }}</span></td>
                                        <td>{{ Str::limit($department->description, 50) }}</td>
                                        <td>
                                            <a href="{{ route('departments.show', $department) }}" class="btn btn-sm btn-info btn-action" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" action="{{ route('departments.destroy', $department) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No departments found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $departments->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
