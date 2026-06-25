<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ $department->name }}</h1>
            <div>
                <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Department Code</h6>
                                <p class="fs-5"><span class="badge bg-secondary">{{ $department->code }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Department Name</h6>
                                <p class="fs-5"><strong>{{ $department->name }}</strong></p>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6 class="text-muted">Description</h6>
                            <p>{{ $department->description ?: 'No description provided' }}</p>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Created</h6>
                                <p>{{ $department->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Last Updated</h6>
                                <p>{{ $department->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
