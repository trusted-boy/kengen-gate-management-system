<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h1>Drivers</h1>
            <a href="{{ route('drivers.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Driver
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('drivers.index') }}" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, employee ID or license" value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Employee ID</th>
                                <th>License #</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($drivers as $driver)
                                <tr>
                                    <td>{{ $driver->full_name }}</td>
                                    <td>{{ $driver->employee_id ?? '-' }}</td>
                                    <td>{{ $driver->license_number ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $driver->status === 'Active' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $driver->status }}
                                        </span>
                                    </td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('drivers.show', $driver) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form method="POST" action="{{ route('drivers.destroy', $driver) }}" onsubmit="return confirm('Delete this driver?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No drivers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div>
                    {{ $drivers->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

