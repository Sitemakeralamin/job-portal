<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Job Applications
        </h2>
    </x-slot>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('applications.create') }}" class="shadow btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> New Application
            </a>
        </div>

        <div class="border-0 shadow-lg card rounded-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $app)
                            <tr>
                                <td>
                                    @if($app->photo)
                                        <img src="{{ asset($app->photo) }}" class="shadow-sm rounded-circle" width="45" height="45" style="object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/45" class="rounded-circle">
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $app->name }}</td>
                                <td><span class="badge bg-info text-dark">{{ $app->job->title ?? 'N/A' }}</span></td>
                                <td>{{ $app->phone }}</td>
                                <td>
                                    @if($app->status == 1)
                                        <span class="badge bg-success-subtle text-success">ACCEPTED</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">PENDING</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('applications.edit', $app->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('applications.destroy', $app->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
