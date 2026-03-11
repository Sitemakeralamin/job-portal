<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Job
        </h2>
    </x-slot>

    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="border-0 shadow-lg card rounded-4">

                    <div class="py-3 card-header bg-warning text-dark">
                        <h4 class="mb-0 text-center">
                            <i class="bi bi-pencil me-2"></i> Update Job Information
                        </h4>
                    </div>

                    <div class="p-4 card-body p-md-5 bg-light">
                        <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                {{-- Job Title --}}
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-dark">Job Title</label>
                                    <input type="text" name="title" value="{{ old('title', $job->title) }}" class="form-control form-control-lg" required>
                                </div>

                                {{-- Country --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark">Country</label>
                                    <input type="text" name="country" value="{{ old('country', $job->country) }}" class="form-control form-control-lg">
                                </div>

                                {{-- Category --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark">Category</label>
                                    <input type="text" name="category" value="{{ old('category', $job->category) }}" class="form-control form-control-lg" required>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-dark">Status</label>
                                    <div class="mt-2 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" {{ $job->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusSwitch">
                                            Active
                                        </label>
                                    </div>
                                </div>

                                {{-- Photo --}}
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-dark">Change Photo (Optional)</label>
                                    <input type="file" name="photo" class="form-control form-control-lg">

                                    @if($job->photo)
                                    <div class="mt-2">
                                        <small class="text-muted">Current Photo:</small><br>
                                        <img src="{{ asset($job->photo) }}" class="mt-1 border rounded" width="80">
                                    </div>
                                    @endif
                                </div>

                            </div>

                            <div class="mt-5 d-grid">
                                <button type="submit" class="py-3 shadow btn btn-warning btn-lg rounded-pill">
                                    <i class="bi bi-arrow-repeat me-2"></i> Update Job
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
