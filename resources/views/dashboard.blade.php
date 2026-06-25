<x-app-layout>
    <x-slot name="header">
        <h1>Dashboard Analytics</h1>
    </x-slot>

    <div class="container-fluid">
        <!-- Key Metrics Cards -->
        <div class="row mb-4">
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card stat-card visitors">
                    <div class="card-body">
                        <div class="stat-card-title">Visitors Inside</div>
                        <div class="stat-card-value">{{ $visitorsInside }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card stat-card interns">
                    <div class="card-body">
                        <div class="stat-card-title">Interns Present</div>
                        <div class="stat-card-value">{{ $internsPresent }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card stat-card vehicles">
                    <div class="card-body">
                        <div class="stat-card-title">Active Vehicles</div>
                        <div class="stat-card-value">{{ $activeVehicles }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card stat-card contractors">
                    <div class="card-body">
                        <div class="stat-card-title">Active Contractors</div>
                        <div class="stat-card-value">{{ $activeContractors }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Visitor Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted">Visitors Checked Out</p>
                                <h4>{{ $visitorsOutside }}</h4>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted">Today's Check-ins</p>
                                <h4>{{ $todayVisitors }}</h4>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <p class="text-muted">Total Visitors</p>
                            <h4>{{ $totalVisitors }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Interns & Attachees Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted">Today's Check-ins</p>
                                <h4>{{ $todayInterns }}</h4>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted">Total Interns</p>
                                <h4>{{ $totalInterns }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Last Check-ins -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Last Visitor Activities</h6>
                    </div>
                    <div class="card-body">
                        @if($lastVisitorCheckIn)
                            <div class="mb-3">
                                <p class="text-muted mb-1">Last Check-In</p>
                                <p><strong>{{ $lastVisitorCheckIn->full_name }}</strong></p>
                                <small class="text-muted">{{ $lastVisitorCheckIn->check_in_time->diffForHumans() }}</small>
                            </div>
                        @endif

                        @if($lastVisitorCheckOut)
                            <hr>
                            <div>
                                <p class="text-muted mb-1">Last Check-Out</p>
                                <p><strong>{{ $lastVisitorCheckOut->full_name }}</strong></p>
                                <small class="text-muted">{{ $lastVisitorCheckOut->check_out_time->diffForHumans() }}</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">System Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted">Total Departments</p>
                                <h4>{{ $totalDepartments }}</h4>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted">Total Vehicles</p>
                                <h4>{{ $totalVehicles }}</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted">Total Contractors</p>
                                <h4>{{ $totalContractors }}</h4>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted">Equipment Movements</p>
                                <h4>{{ $totalMovements }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Quick Navigation</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <a href="{{ route('visitors.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-person-check"></i> Visitors
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('interns_attachees.index') }}" class="btn btn-outline-info w-100">
                                    <i class="bi bi-people"></i> Interns
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('vehicles.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-car-front"></i> Vehicles
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('contractors.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-building"></i> Contractors
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
