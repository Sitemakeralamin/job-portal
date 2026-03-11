<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Create New Job
        </h2>
    </x-slot>

    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <div class="overflow-hidden border-0 shadow-lg card rounded-4">

                    {{-- Card Header --}}
                    <div class="py-3 text-white card-header bg-primary">
                        <h4 class="mb-0 text-center">
                            <i class="bi bi-briefcase-fill me-2"></i> Post a New Job
                        </h4>
                    </div>

                    <div class="p-4 card-body p-md-5 bg-light">
                        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">

                                {{-- Job Title --}}
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-dark">
                                        Job Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" placeholder="e.g. Senior Laravel Developer" required>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Country --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark">Country</label>
                                    <input type="text" name="country" class="form-control form-control-lg @error('country') is-invalid @enderror" placeholder="e.g. Saudi Arabia">
                                    @error('country')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Category --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark">
                                        Category <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="category" class="form-control form-control-lg @error('category') is-invalid @enderror" placeholder="e.g. IT / Engineering" required>
                                    @error('category')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-dark">Status</label>
                                    <div class="mt-2 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" checked>
                                        <label class="form-check-label" for="statusSwitch">
                                            <span class="badge bg-success">Active</span>
                                        </label>
                                    </div>
                                    <small class="text-muted">Toggle to make job active or inactive.</small>
                                </div>

                                {{-- Photo --}}
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-dark">Job Banner / Photo</label>
                                    <input type="file" name="photo" class="form-control form-control-lg @error('photo') is-invalid @enderror">
                                    @error('photo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            {{-- Submit Button --}}
                            <div class="mt-5 d-grid">
                                <button type="submit" class="py-3 shadow btn btn-primary btn-lg rounded-pill">
                                    <i class="bi bi-plus-circle me-2"></i> Publish Job
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
