<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Create Job
        </h2>
    </x-slot>

    <div class="container py-2">
        <div class="border-0 shadow-lg card rounded-4">

            {{-- Card Header --}}
            <div class="py-3 bg-white card-header border-bottom">
                <h4 class="mb-0 text-dark">New Job Application</h4>
            </div>

            <div class="p-4 card-body p-md-5">
                <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Candidate Information Section --}}
                    <div class="mb-4 border-1 border-start border-primary ps-3">
                        <h5 class="mb-0 text-primary fw-bold">Candidate Information</h5>
                        <small class="text-muted">Enter personal details here</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Name <small class="text-danger fw-bold">*</small></label>
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Full Name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Phone <small class="text-danger fw-bold">*</small></label>
                            <input type="number" name="phone" class="form-control form-control-lg" placeholder="+880 1XXX-XXXXXX" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="example@email.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Gender</label>
                            <select name="gender" class="form-select form-select-lg">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control form-control-lg">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Photo</label>
                            <input type="file" name="photo" class="form-control form-control-lg">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-medium text-secondary">Address</label>
                            <textarea name="address" class="form-control form-control-lg" rows="2" placeholder="Full Address"></textarea>
                        </div>
                    </div>

                    <hr class="my-5">

                    {{-- Job Category Section --}}
                    <div class="mb-4 border-1 border-start border-success ps-3">
                        <h5 class="mb-0 text-success fw-bold">Job Category</h5>
                        <small class="text-muted">Select desired position</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Select Job <small class="text-danger fw-bold">*</small></label>
                            <select name="job_id" class="form-select form-select-lg">
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}">
                                        {{ $job->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                             <label class="form-label fw-medium text-secondary">Payment </label>
                            <select name="payment" class="form-select form-select-lg">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-5">

                    {{-- Additional Information Section --}}
                    <div class="mb-4 border-1 border-start border-info ps-3">
                        <h5 class="mb-0 text-info fw-bold">Additional Information</h5>
                        <small class="text-muted">Other necessary details</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Passport No <small class="text-danger fw-bold">*</small></label>
                            <input type="number" name="passport_no" class="form-control form-control-lg" placeholder="Passport Number">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Nationality</label>
                            <input type="text" name="nationality" class="form-control form-control-lg" placeholder="e.g. Bangladeshi">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Current Country</label>
                            <input type="text" name="current_country" class="form-control form-control-lg" placeholder="Current Location">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">English Certificate</label>
                            <select name="english_certificate" class="form-select form-select-lg">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Experience Year</label>
                            <input type="number" name="experience_year" class="form-control form-control-lg" placeholder="Years of experience">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Work Related Video Link</label>
                            <input type="text" name="video_link" class="form-control form-control-lg" placeholder="YouTube/Drive Link">
                        </div>
                    </div>

                    <div class="mt-5 text-end">
                        <button type="submit" class="px-5 shadow btn btn-success btn-lg rounded-pill">
                            <i class="bi bi-check-circle me-2"></i> Submit Application
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
