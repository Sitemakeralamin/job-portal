<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Job List
        </h2>
    </x-slot>

    <div class="container py-2">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('jobs.create') }}" class="shadow btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New Job
            </a>
        </div>

        <div class="border-0 shadow-lg card rounded-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>SL</th>
                                <th>Photo</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $key => $job)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    @if($job->photo)
                                        <img src="{{ asset($job->photo) }}" width="50" height="50" class="shadow-sm rounded-circle" style="object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/50" width="50" height="50" class="rounded-circle">
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $job->title }}</td>
                                <td>{{ $job->category }}</td>
                                <td>{{ $job->country }}</td>
                                <td>
                                    @if($job->status == 1)
                                        <span class="badge bg-success-subtle text-success">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
