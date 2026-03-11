<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Application
        </h2>
    </x-slot>

    <div class="container py-2">
        <div class="border-0 shadow-lg card rounded-4">
            <div class="py-3 bg-white card-header border-bottom">
                <h4 class="mb-0 text-dark">Update Application Info</h4>
            </div>

            <div class="p-4 card-body p-md-5">
                {{-- Note the route('applications.update') and @method('PUT') --}}
                <form action="{{ route('applications.update', $application->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Candidate Information Section --}}
                    <div class="mb-4 border-1 border-start border-primary ps-3">
                        <h5 class="mb-0 text-primary fw-bold">Candidate Information</h5>
                        <small class="text-muted">Update personal details here</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Name</label>
                            <input type="text" name="name" value="{{ old('name', $application->name) }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $application->phone) }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Email</label>
                            <input type="email" name="email" value="{{ old('email', $application->email) }}" class="form-control form-control-lg">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Gender</label>
                            <select name="gender" class="form-select form-select-lg">
                                <option value="Male" {{ $application->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $application->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $application->date_of_birth) }}" class="form-control form-control-lg">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Photo</label>
                            <input type="file" name="photo" class="form-control form-control-lg">
                            @if($application->photo)
                                <img src="{{ asset($application->photo) }}" class="mt-2 rounded" width="60">
                            @endif
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-medium text-secondary">Address</label>
                            <textarea name="address" class="form-control form-control-lg" rows="2">{{ old('address', $application->address) }}</textarea>
                        </div>
                    </div>

                    <hr class="my-5">

                    {{-- Job Category Section --}}
                    <div class="mb-4 border-1 border-start border-success ps-3">
                        <h5 class="mb-0 text-success fw-bold">Job Category</h5>
                        <small class="text-muted">Update desired position</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Select Job</label>
                            <select name="job_id" class="form-select form-select-lg">
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}" {{ $application->job_id == $job->id ? 'selected' : '' }}>
                                        {{ $job->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="my-5">

                    {{-- Additional Information Section --}}
                    <div class="mb-4 border-1 border-start border-info ps-3">
                        <h5 class="mb-0 text-info fw-bold">Additional Information</h5>
                        <small class="text-muted">Update other details</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Passport No</label>
                            <input type="text" name="passport_no" value="{{ old('passport_no', $application->passport_no) }}" class="form-control form-control-lg">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Nationality</label>
                            <input type="text" name="nationality" value="{{ old('nationality', $application->nationality) }}" class="form-control form-control-lg">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Current Country</label>
                            <input type="text" name="current_country" value="{{ old('current_country', $application->current_country) }}" class="form-control form-control-lg">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">English Certificate</label>
                            <select name="english_certificate" class="form-select form-select-lg">
                                <option value="1" {{ $application->english_certificate == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ $application->english_certificate == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Experience Year</label>
                            <input type="number" name="experience_year" value="{{ old('experience_year', $application->experience_year) }}" class="form-control form-control-lg">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Work Related Video Link</label>
                            <input type="text" name="video_link" value="{{ old('video_link', $application->video_link) }}" class="form-control form-control-lg">
                        </div>

                        {{-- Status Switch --}}
                        <div class="col-md-12">
                             <label class="form-label fw-medium text-secondary">Status</label>
                             <div class="mt-2 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" {{ $application->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusSwitch">Accepted</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-end">
                        <button type="submit" class="px-5 shadow btn btn-warning btn-lg rounded-pill">
                            <i class="bi bi-arrow-repeat me-2"></i> Update Application
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
