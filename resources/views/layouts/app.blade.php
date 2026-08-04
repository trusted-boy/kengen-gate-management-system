<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>KenGen Gate Management System</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <style>
            :root {
                --sidebar-width: 260px;
            }

            body {
                display: flex;
            }

            .sidebar {
                width: var(--sidebar-width);
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                min-height: 100vh;
                position: fixed;
                left: 0;
                top: 0;
                overflow-y: auto;
                padding: 20px 0;
            }

            .main-content {
                flex: 1;
                margin-left: var(--sidebar-width);
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .sidebar .brand {
                padding: 0 20px 30px;
                border-bottom: 1px solid rgba(255,255,255,0.1);
                margin-bottom: 20px;
            }

            .sidebar .brand h5 {
                margin: 0;
                font-weight: 700;
                font-size: 1.25rem;
            }

            .sidebar .brand p {
                margin: 0;
                font-size: 0.875rem;
                opacity: 0.9;
            }

            .sidebar-nav {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .sidebar-nav-item {
                margin: 5px 0;
            }

            .sidebar-nav-link {
                display: flex;
                align-items: center;
                padding: 12px 20px;
                color: rgba(255,255,255,0.8);
                text-decoration: none;
                transition: all 0.3s ease;
                border-left: 3px solid transparent;
            }

            .sidebar-nav-link:hover {
                color: white;
                background-color: rgba(255,255,255,0.1);
                border-left-color: white;
            }

            .sidebar-nav-link.active {
                color: white;
                background-color: rgba(255,255,255,0.15);
                border-left-color: white;
                font-weight: 600;
            }

            .sidebar-nav-link i {
                width: 24px;
                margin-right: 12px;
                text-align: center;
            }

            .topbar {
                background: white;
                border-bottom: 1px solid #e9ecef;
                padding: 15px 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .page-header {
                background: white;
                padding: 20px 30px;
                border-bottom: 1px solid #e9ecef;
            }

            .page-header h1 {
                margin: 0;
                font-size: 1.75rem;
                color: #333;
                font-weight: 600;
            }

            .page-content {
                flex: 1;
                padding: 30px;
                background: #f8f9fa;
            }

            .card {
                border: none;
                border-radius: 0.5rem;
                box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            }

            .stat-card {
                background: white;
                border-left: 4px solid;
            }

            .stat-card.visitors {
                border-left-color: #667eea;
            }

            .stat-card.vehicles {
                border-left-color: #f093fb;
            }

            .stat-card.contractors {
                border-left-color: #4facfe;
            }

            .stat-card.equipment {
                border-left-color: #43e97b;
            }

            .stat-card.interns {
                border-left-color: #ff6b6b;
            }

            .stat-card.staff {
                border-left-color: #20c997;
            }

            .stat-card-title {
                color: #6c757d;
                font-size: 0.875rem;
                font-weight: 600;
                text-transform: uppercase;
                margin-bottom: 10px;
            }

            .stat-card-value {
                font-size: 2rem;
                font-weight: 700;
                color: #333;
            }

            @media (max-width: 768px) {
                :root {
                    --sidebar-width: 0;
                }

                .sidebar {
                    width: 260px;
                    z-index: 1000;
                    transform: translateX(-100%);
                    transition: transform 0.3s ease;
                }

                .sidebar.show {
                    transform: translateX(0);
                }

                .main-content {
                    margin-left: 0;
                }

                .sidebar-toggle {
                    display: block !important;
                }
            }

            @media (min-width: 769px) {
                .sidebar-toggle {
                    display: none !important;
                }
            }

            .table-responsive {
                background: white;
                border-radius: 0.5rem;
            }

            .btn-action {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }

            .badge-status {
                padding: 0.5rem 0.75rem;
                border-radius: 0.25rem;
                font-size: 0.875rem;
            }

            .badge-active {
                background-color: #d4edda;
                color: #155724;
            }

            .badge-inactive {
                background-color: #f8d7da;
                color: #721c24;
            }

            .badge-in {
                background-color: #d4edda;
                color: #155724;
            }

            .badge-out {
                background-color: #cfe2ff;
                color: #084298;
            }
        </style>
    </head>
    <body class="bg-light">
        @include('layouts.sidebar')

        <div class="main-content">
            @include('layouts.topbar')

            @isset($header)
                <div class="page-header">
                    {{ $header }}
                </div>
            @endisset

            <div class="page-content">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Errors:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebarToggle = document.querySelector('.sidebar-toggle');
                const sidebar = document.querySelector('.sidebar');

                if (sidebarToggle) {
                    sidebarToggle.addEventListener('click', function() {
                        sidebar.classList.toggle('show');
                    });
                }

                // Close sidebar when clicking outside
                document.addEventListener('click', function(event) {
                    if (!event.target.closest('.sidebar') && !event.target.closest('.sidebar-toggle')) {
                        sidebar.classList.remove('show');
                    }
                });
            });
        </script>
    </body>
</html>
