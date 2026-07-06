<nav class="topbar">
    <div>
        <button class="btn btn-link sidebar-toggle d-md-none" style="color: #667eea;" aria-label="Toggle sidebar">
            <i class="bi bi-list fs-5"></i>
        </button>
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="dropdown">
            <button class="btn btn-link text-decoration-none text-dark dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
                <span class="ms-2">{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><span class="dropdown-item-text"><strong>{{ Auth::user()->name }}</strong></span></li>
                <li><span class="dropdown-item-text text-muted" style="font-size: 0.875rem;">{{ Auth::user()->role }}</span></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
