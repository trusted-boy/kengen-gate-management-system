<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Equipment Movement Tracking</h1>
            <a href="{{ route('equipment_movements.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Check Out Equipment
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('equipment_movements.index') }}" class="row g-3">
                            <div class="col-md-9">
                                <input type="text" name="search" class="form-control" placeholder="Search by equipment name, owner, or recipient..." value="{{ $search }}">
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
                                    <th>Equipment</th>
                                    <th>Type</th>
                                    <th>Owner</th>
                                    <th>Recipient</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($movements as $movement)
                                    <tr>
                                        <td>{{ $loop->iteration + ($movements->currentPage() - 1) * $movements->perPage() }}</td>
                                        <td><strong>{{ $movement->equipment_name }}</strong></td>
                                        <td>{{ $movement->equipment_type }}</td>
                                        <td>{{ $movement->owner_name }}</td>
                                        <td>{{ $movement->recipient_name }}</td>
                                        <td>{{ $movement->check_out_time->format('M d, Y H:i') }}</td>
                                        <td>
                                            @if($movement->status === 'Out')
                                                <span class="badge" style="background-color: #cfe2ff; color: #084298;">Out</span>
                                            @else
                                                <span class="badge badge-status badge-active">In</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('equipment_movements.show', $movement) }}" class="btn btn-sm btn-info btn-action" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('equipment_movements.edit', $movement) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" action="{{ route('equipment_movements.destroy', $movement) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                        <td colspan="8" class="text-center text-muted py-4">
                                            No equipment movements found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $movements->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
