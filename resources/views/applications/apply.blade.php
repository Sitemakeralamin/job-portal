<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job - BritFly</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-custom { background-color: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .form-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-submit { padding: 12px 40px; font-size: 1.1rem; }
        .section-title { position: relative; padding-left: 15px; }
        .section-title::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: #0d6efd; border-radius: 2px; }
    </style>
</head>
<body>

    {{-- Navbar --}}
    {{-- <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                <i class="bi bi-airplane-engines-fill me-2"></i>BritFly Jobs
            </a>
            <div class="d-flex">
                <a href="{{ route('applications.track.form') }}" class="btn btn-outline-primary btn-sm me-2">
                    <i class="bi bi-search me-1"></i> Track Application
                </a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-dark btn-sm">Login</a>
                @endauth
            </div>
        </div>
    </nav> --}}

    {{-- Main Content --}}
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                  @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

                {{-- Page Header --}}
                <div class="mb-4 text-center">
                    <h2 class="fw-bold text-dark">New Visa Application</h2>
                    <p class="text-muted">Fill up the form carefully with correct information.</p>
                </div>

                {{-- Form Card --}}
                <div class="card form-card">
                    <div class="p-4 card-body p-md-5">
                        <form action="{{ route('applications.frontend.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Candidate Information --}}
                            <div class="mb-4 section-title">
                                <h5 class="mb-0 text-primary fw-bold">Candidate Information</h5>
                                <small class="text-muted">Enter personal details here</small>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Full Name" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control form-control-lg" placeholder="+880 1XXX-XXXXXX" required>
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

                            {{-- Job Category --}}
                            <div class="mb-4 section-title" style="border-color: #198754;">
                                <h5 class="mb-0 text-success fw-bold">Job Category</h5>
                                <small class="text-muted">Select desired position</small>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Select Job <span class="text-danger">*</span></label>
                                    <select name="job_id" class="form-select form-select-lg" required>
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job->id }}">{{ $job->title }}</option>
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

                            {{-- Additional Information --}}
                            <div class="mb-4 section-title" style="border-color: #0dcaf0;">
                                <h5 class="mb-0 text-info fw-bold">Additional Information</h5>
                                <small class="text-muted">Other necessary details</small>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-secondary">Passport No</label>
                                    <input type="text" name="passport_no" class="form-control form-control-lg" placeholder="Passport Number">
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

                            <div class="mt-5 text-center">
                                <button type="submit" class="px-5 shadow btn btn-success btn-lg rounded-pill btn-submit">
                                    <i class="bi bi-check-circle me-2"></i> Submit Application
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="py-4 mt-5 text-center bg-white border-top">
        <p class="mb-0 text-muted small">&copy; 2026 BritFly Jobs. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
