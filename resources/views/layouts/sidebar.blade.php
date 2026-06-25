<aside class="sidebar">
    <div class="brand">
        <h5><i class="bi bi-shield-lock"></i> KenGen Gate</h5>
        <p>Management System</p>
    </div>

    <button class="sidebar-toggle d-md-none" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: white; cursor: pointer;">
        <i class="bi bi-x-lg fs-5"></i>
    </button>

    <ul class="sidebar-nav">
        <li class="sidebar-nav-item">
            <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li class="sidebar-nav-item" style="margin-top: 20px; padding: 0 20px; opacity: 0.7; font-size: 0.875rem; font-weight: 600; text-transform: uppercase;">
            OPERATIONS
        </li>

        <li class="sidebar-nav-item">
            <a href="{{ route('visitors.index') }}" class="sidebar-nav-link {{ request()->routeIs('visitors*') ? 'active' : '' }}">
                <i class="bi bi-person-check"></i>
                Visitors
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="{{ route('interns_attachees.index') }}" class="sidebar-nav-link {{ request()->routeIs('interns_attachees*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                Interns & Attachees
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="{{ route('vehicles.index') }}" class="sidebar-nav-link {{ request()->routeIs('vehicles*') ? 'active' : '' }}">
                <i class="bi bi-car-front"></i>
                Vehicles
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="{{ route('contractors.index') }}" class="sidebar-nav-link {{ request()->routeIs('contractors*') ? 'active' : '' }}">
                <i class="bi bi-building"></i>
                Contractors
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="{{ route('equipment_movements.index') }}" class="sidebar-nav-link {{ request()->routeIs('equipment_movements*') ? 'active' : '' }}">
                <i class="bi bi-boxes"></i>
                Equipment
            </a>
        </li>

        <li class="sidebar-nav-item" style="margin-top: 20px; padding: 0 20px; opacity: 0.7; font-size: 0.875rem; font-weight: 600; text-transform: uppercase;">
            ADMIN
        </li>

        <li class="sidebar-nav-item">
            <a href="{{ route('departments.index') }}" class="sidebar-nav-link {{ request()->routeIs('departments*') ? 'active' : '' }}">
                <i class="bi bi-diagram-3"></i>
                Departments
            </a>
        </li>

        @if(Auth::user() && in_array(Auth::user()->role, ['Admin', 'Supervisor']))
            <li class="sidebar-nav-item" style="margin-top: 20px; padding: 0 20px; opacity: 0.7; font-size: 0.875rem; font-weight: 600; text-transform: uppercase;">
                REPORTS
            </li>

            <li class="sidebar-nav-item">
                <a href="{{ route('reports.pdf') }}" class="sidebar-nav-link">
                    <i class="bi bi-file-pdf"></i>
                    PDF Reports
                </a>
            </li>

            <li class="sidebar-nav-item">
                <a href="{{ route('reports.excel') }}" class="sidebar-nav-link">
                    <i class="bi bi-file-earmark-spreadsheet"></i>
                    Excel Reports
                </a>
            </li>
        @endif
    </ul>
</aside>
