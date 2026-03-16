<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Application</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    body {
        background-color: #f4f7f6;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .center-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    .search-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .result-card {
        border-radius: 15px;
        border-left: 5px solid #0d6efd;
        transition: transform 0.2s;
    }

    .result-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .status-badge {
        font-size: 0.9rem;
        padding: 5px 15px;
        border-radius: 20px;
    }
</style>


</head>

<body>

<div class="container center-section">
    <div class="row justify-content-center w-100">


    <div class="col-md-8">

        {{-- Search Form --}}
        <div class="p-4 mb-5 card search-card">
            <div class="text-center card-body">

                <h3 class="mb-3 text-dark">Track Your Application</h3>

                <p class="mb-4 text-muted">
                    Enter your Passport number to check the current status of your application.
                </p>

                <form action="{{ route('applications.track.search') }}" method="POST">
                    @csrf

                    <div class="overflow-hidden shadow-sm input-group input-group-lg rounded-pill">

                        <span class="bg-white border-0 input-group-text">
                            <i class="bi bi-search text-primary"></i>
                        </span>

                        <input type="text"
                               name="passport_no"
                               class="border-0 form-control"
                               placeholder="Enter Passport Number (e.g. A12850583)"
                               value="{{ request('passport_no') }}"
                               required>

                        <button class="px-4 btn btn-primary" type="submit">
                            Search
                        </button>

                    </div>

                </form>

            </div>
        </div>


        {{-- RESULT SECTION --}}
        @if(isset($applications))

            @if($applications->count() > 0)

                <h5 class="mb-3 text-muted">
                    Found {{ $applications->count() }} Application(s)
                </h5>

                @foreach ($applications as $app)

                <div class="mb-3 card result-card">

                    <div class="card-body">

                        <div class="row align-items-center">

                            {{-- Photo --}}
                            <div class="mb-3 text-center col-md-2 mb-md-0">

                                @if($app->photo)
                                    <img src="{{ asset($app->photo) }}"
                                         class="shadow rounded-circle"
                                         width="60"
                                         height="60"
                                         style="object-fit:cover;">
                                @else
                                    <img src="https://via.placeholder.com/60"
                                         class="shadow rounded-circle">
                                @endif

                            </div>

                            {{-- Details --}}
                            <div class="col-md-7">

                                <h5 class="mb-1 text-dark fw-bold">
                                    {{ $app->name }}
                                </h5>

                                <p class="mb-1 text-muted small">
                                    <i class="bi bi-briefcase me-1"></i>
                                    {{ $app->job->title ?? 'N/A' }}
                                </p>

                                <p class="mb-0 text-muted small">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    Applied at: {{ $app->created_at->format('d/m/Y') }}
                                </p>

                            </div>

                            {{-- Status --}}
                            <div class="mt-3 col-md-3 text-md-end mt-md-0">

                                @php
                                    $status_class = 'bg-secondary';
                                    $status_text = 'Pending';

                                    if($app->status == 0) {
                                        $status_class = 'bg-warning text-dark';
                                        $status_text = 'Pending';
                                    }

                                    if($app->status == 1) {
                                        $status_class = 'bg-success';
                                        $status_text = 'ACCEPTED';
                                    }

                                    if($app->status == 2) {
                                        $status_class = 'bg-danger';
                                        $status_text = 'Rejected';
                                    }
                                @endphp

                                <span class="badge status-badge {{ $status_class }}">
                                    {{ $status_text }}
                                </span>

                                <br>

                                <small class="mt-2 text-muted d-block">
                                    ID: #{{ $app->id }}
                                </small>

                                @if ($app->payment == 1)

                                    <a href="{{ route('applications.print', $app->id) }}"
                                       target="_blank"
                                       class="mt-2 btn btn-sm btn-outline-dark">

                                        <i class="bi bi-printer me-1"></i>
                                        Print
                                    </a>

                                @else

                                    <span class="text-danger">Not Paid</span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach

            @else

            {{-- No Result --}}
            <div class="p-5 text-center border-0 shadow-sm card">

                <i class="bi bi-emoji-frown text-warning"
                   style="font-size: 3rem;"></i>

                <h4 class="mt-3 text-dark">
                    No Application Found
                </h4>

                <p class="text-muted">
                    No application found with this passport number.
                    Please check the number and try again.
                </p>

            </div>

            @endif

            <div class="mt-4 text-center">

                <a href="{{ route('applications.apply') }}"
                   class="px-4 btn btn-outline-primary rounded-pill">

                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Return to Application Form

                </a>

            </div>

        @endif

    </div>

</div>

</div>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
