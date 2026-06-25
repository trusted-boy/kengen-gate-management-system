<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Vehicle Register</h1>
            <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Vehicle
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('vehicles.index') }}" class="row g-3">
                            <div class="col-md-9">
                                <input type="text" name="search" class="form-control" placeholder="Search by registration number, type, or owner..." value="{{ $search }}">
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
                                    <th>Registration Number</th>
                                    <th>Type</th>
                                    <th>Make/Model</th>
                                    <th>Owner</th>
                                    <th>Status</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $loop->iteration + ($vehicles->currentPage() - 1) * $vehicles->perPage() }}</td>
                                        <td><strong>{{ $vehicle->registration_number }}</strong></td>
                                        <td>{{ $vehicle->vehicle_type }}</td>
                                        <td>{{ $vehicle->make_model }} ({{ $vehicle->year }})</td>
                                        <td>{{ $vehicle->owner_name }}</td>
                                        <td>
                                            @if($vehicle->status === 'Active')
                                                <span class="badge badge-status badge-active">{{ $vehicle->status }}</span>
                                            @elseif($vehicle->status === 'Inactive')
                                                <span class="badge badge-status badge-inactive">{{ $vehicle->status }}</span>
                                            @else
                                                <span class="badge badge-status" style="background-color: #fff3cd; color: #856404;">{{ $vehicle->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-sm btn-info btn-action" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" action="{{ route('vehicles.destroy', $vehicle) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                            No vehicles found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $vehicles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
