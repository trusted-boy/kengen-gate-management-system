<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Vehicle Trips</h1>
            <a href="{{ route('vehicle_trips.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Create Trip
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('vehicle_trips.index') }}" class="row g-3">
                            <div class="col-md-9">
                                <input type="text" name="search" class="form-control" placeholder="Search by vehicle, driver, destination..." value="{{ $search }}">
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
                                    <th>Vehicle</th>
                                    <th>Driver</th>
                                    <th>Departure → Return</th>
                                    <th>Distance</th>
                                    <th>Status</th>
                                    <th style="width: 180px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trips as $trip)
                                    <tr>
                                        <td>{{ $loop->iteration + ($trips->currentPage() - 1) * $trips->perPage() }}</td>
                                        <td><strong>{{ $trip->vehicle->registration_number ?? '-' }}</strong></td>
                                        <td>{{ $trip->driver->full_name ?? '-' }}</td>
                                        <td>
                                            <div><small class="text-muted">{{ $trip->departure_gate }}</small></div>
                                            <div class="fw-semibold">{{ optional($trip->departure_at)->format('d/m/Y H:i') }}</div>
                                            <hr class="my-2">
                                            <div><small class="text-muted">{{ $trip->return_gate }}</small></div>
                                            <div class="fw-semibold">{{ $trip->actual_return_at ? $trip->actual_return_at->format('d/m/Y H:i') : '-' }}</div>
                                        </td>
                                        <td>
                                            {{ number_format($trip->distance_km, 0) }} km
                                        </td>
                                        <td>
                                            @php($status = $trip->status)
                                            <span class="badge {{ $status === 'Active' ? 'bg-success' : ($status === 'Completed' ? 'bg-primary' : 'bg-warning text-dark') }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('vehicle_trips.show', $trip) }}" class="btn btn-sm btn-info btn-action" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('vehicle_trips.edit', $trip) }}" class="btn btn-sm btn-primary btn-action" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" action="{{ route('vehicle_trips.destroy', $trip) }}" class="d-inline" onsubmit="return confirm('Delete this trip?')">
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
                                        <td colspan="7" class="text-center text-muted py-4">No trips found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $trips->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

