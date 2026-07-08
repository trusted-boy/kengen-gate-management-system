<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h1>Driver Details</h1>
            <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-primary">Edit</a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="mb-1">{{ $driver->full_name }}</h4>
                        <div class="text-muted">Employee ID: {{ $driver->employee_id ?? '-' }}</div>
                        <div class="text-muted">Phone: {{ $driver->phone ?? '-' }}</div>
                        <div class="text-muted">License #: {{ $driver->license_number ?? '-' }}</div>
                        <div class="text-muted">License Expiry: {{ optional($driver->license_expiry_date)->format('d/m/Y') ?? '-' }}</div>
                        <div class="text-muted">License Category: {{ $driver->license_category ?? '-' }}</div>

                        <div class="mt-2">
                            <span class="badge {{ $driver->status === 'Active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $driver->status }}
                            </span>
                        </div>

                        @if($driver->remarks)
                            <div class="mt-3">
                                <strong>Remarks:</strong>
                                <div>{{ $driver->remarks }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Assigned Vehicles</h5>
                        @if($driver->vehicles->isEmpty())
                            <div class="text-muted">No vehicles assigned.</div>
                        @else
                            <ul class="list-unstyled mb-0">
                                @foreach($driver->vehicles as $vehicle)
                                    <li class="mb-2">
                                        <span class="fw-semibold">{{ $vehicle->registration_number }}</span>
                                        <div class="text-muted">{{ $vehicle->vehicle_type }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

