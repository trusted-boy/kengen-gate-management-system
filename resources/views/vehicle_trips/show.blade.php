<x-app-layout>
    <x-slot name="header">
        <div>
            <h1>Vehicle Trip Details</h1>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="fw-semibold">Vehicle</div>
                                <div>{{ $vehicleTrip->vehicle->registration_number ?? '-' }} ({{ $vehicleTrip->vehicle->vehicle_type ?? '' }})</div>
                            </div>
                            <div class="col-md-6">
                                <div class="fw-semibold">Driver</div>
                                <div>{{ $vehicleTrip->driver->full_name ?? '-' }}</div>
                            </div>

                            <div class="col-md-6">
                                <div class="fw-semibold">Departure</div>
                                <div>{{ $vehicleTrip->departure_gate }} - {{ $vehicleTrip->departure_at ? $vehicleTrip->departure_at->format('d/m/Y H:i') : '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="fw-semibold">Return</div>
                                <div>{{ $vehicleTrip->return_gate }} - {{ $vehicleTrip->actual_return_at ? $vehicleTrip->actual_return_at->format('d/m/Y H:i') : '-' }}</div>
                            </div>

                            <div class="col-md-4">
                                <div class="fw-semibold">Destination</div>
                                <div>{{ $vehicleTrip->destination }}</div>
                            </div>
                            <div class="col-md-8">
                                <div class="fw-semibold">Purpose</div>
                                <div>{{ $vehicleTrip->purpose_of_trip }}</div>
                            </div>

                            <div class="col-md-4">
                                <div class="fw-semibold">Distance Travelled</div>
                                <div class="fs-4">{{ number_format($vehicleTrip->distance_km, 0) }} km</div>
                            </div>
                            <div class="col-md-8">
                                <div class="fw-semibold">Status</div>
                                <div>
                                    <span class="badge {{ $vehicleTrip->status === 'Active' ? 'bg-success' : ($vehicleTrip->status === 'Completed' ? 'bg-primary' : 'bg-warning text-dark') }}">
                                        {{ $vehicleTrip->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fw-semibold">Departure Odometer</div>
                                <div>{{ number_format($vehicleTrip->departure_odometer_km, 0) }} km</div>
                            </div>
                            <div class="col-md-6">
                                <div class="fw-semibold">Return Odometer</div>
                                <div>{{ $vehicleTrip->return_odometer_km !== null ? number_format($vehicleTrip->return_odometer_km, 0) . ' km' : '-' }}</div>
                            </div>

                            <div class="col-md-12">
                                <div class="fw-semibold">Remarks</div>
                                <div class="text-muted">{{ $vehicleTrip->remarks ?? '-' }}</div>
                            </div>

                            @php($p = $vehicleTrip->passengers)
                            <div class="col-md-12">
                                <hr/>
                                <h5 class="mb-3">Passengers</h5>
                                <div class="row">
                                    <div class="col-md-3"><div class="text-muted">Staff</div><div>{{ $p->staff_count ?? 0 }}</div></div>
                                    <div class="col-md-3"><div class="text-muted">Attachés</div><div>{{ $p->attachee_count ?? 0 }}</div></div>
                                    <div class="col-md-3"><div class="text-muted">Contractors</div><div>{{ $p->contractor_count ?? 0 }}</div></div>
                                    <div class="col-md-3"><div class="text-muted">Visitors</div><div>{{ $p->visitor_count ?? 0 }}</div></div>
                                    <div class="col-md-12 mt-2"><div class="text-muted">Total Occupants</div><div class="fs-5">{{ $p->total_occupants ?? 0 }}</div></div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('vehicle_trips.edit', $vehicleTrip) }}" class="btn btn-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('vehicle_trips.index') }}" class="btn btn-outline-secondary">
                                Back to list
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

