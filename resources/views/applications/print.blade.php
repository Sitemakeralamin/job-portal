<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Details - {{ $application->name }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 20px; color: #333; }
        .container { max-width: 800px; margin: auto; border: 1px solid #ddd; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 20px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #666; }

        /* Profile Area Flex Layout */
        .profile-area {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            align-items: flex-start; /* উপরে সমান রাখতে */
        }

        .photo { width: 150px; height: 150px; border: 1px solid #ccc; padding: 2px; flex-shrink: 0; }
        .photo img { width: 100%; height: 100%; object-fit: cover; }

        .info { flex: 1; }
        .info h3 { margin: 0 0 10px; color: #000; }
        .info p { margin: 5px 0; font-size: 14px; }

        /* QR Code Styles */
        .qr-code {
            width: 110px;
            height: 110px;
            border: 1px solid #ccc;
            padding: 5px;
            text-align: center;
            background: #fff;
            flex-shrink: 0; /* সাইজ ছোট বড় না হোক */
        }
        .qr-code img {
            width: 100%;
            height: 100%;
        }
        .qr-code p {
            font-size: 10px;
            margin: 2px 0 0 0;
            color: #666;
        }

        .section-title { background: #f4f4f4; padding: 8px; font-weight: bold; margin-top: 20px; border-left: 4px solid #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 8px; border-bottom: 1px solid #eee; font-size: 14px; }
        td:first-child { font-weight: 600; width: 40%; }

        .status-badge { padding: 4px 10px; border-radius: 4px; color: white; font-weight: bold; text-transform: uppercase; font-size: 12px; }
        .status-accepted { background-color: #28a745; }
        .status-pending { background-color: #ffc107; color: #333; }
        .status-rejected { background-color: #dc3545; }

        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #eee; padding-top: 10px; }

        @media print { body { margin: 0; } .container { border: none; box-shadow: none; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Job Application Details</h2>
            <p>Generated on: {{ now()->format('d M, Y h:i A') }}</p>
        </div>

        <div class="profile-area">
            <div class="photo">
                @if($application->photo)
                    <img src="{{ asset($application->photo) }}" alt="Photo">
                @else
                    <img src="https://via.placeholder.com/150" alt="No Photo">
                @endif
            </div>

            <div class="info">
                <h3>{{ $application->name }}</h3>
                <p><strong>Applied For:</strong> {{ $application->job->title ?? 'N/A' }}</p>
                <p><strong>Status:</strong>
                    <span class="status-badge status-{{ $application->status == 1 ? 'accepted' : ($application->status == 2 ? 'rejected' : 'pending') }}">
                        {{ $application->status == 1 ? 'Accepted' : ($application->status == 2 ? 'Rejected' : 'Pending') }}
                    </span>
                </p>
            </div>

            <!-- QR Code Section Starts -->
            <div class="qr-code">
                @php
                    // QR কোডের জন্য ডাটা প্রস্তুত করা হলো
                    $qrData = "Name: " . $application->name .
                              ", Phone: " . $application->phone .
                              ", Passport: " . ($application->passport_no ?? 'N/A');
                @endphp
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($qrData) }}" alt="QR Code">
                <p>Scan for Info</p>
            </div>
            <!-- QR Code Section Ends -->
        </div>

        <div class="section-title">Personal Information</div>
        <table>
            <tr><td>Phone</td><td>{{ $application->phone }}</td></tr>
            <tr><td>Email</td><td>{{ $application->email ?? 'N/A' }}</td></tr>
            <tr><td>Gender</td><td>{{ $application->gender }}</td></tr>
            <tr><td>Date of Birth</td><td> @if($application->date_of_birth)
                        {{ \Carbon\Carbon::parse($application->date_of_birth)->format('d-M-Y') }}
                    @else
                        N/A
                    @endif</td></tr>
            <tr><td>Address</td><td>{{ $application->address ?? 'N/A' }}</td></tr>
        </table>

        <div class="section-title">Additional Information</div>
        <table>
            <tr><td>Passport No</td><td>{{ $application->passport_no ?? 'N/A' }}</td></tr>
            <tr><td>Nationality</td><td>{{ $application->nationality ?? 'N/A' }}</td></tr>
            <tr><td>Current Country</td><td>{{ $application->current_country ?? 'N/A' }}</td></tr>
            <tr><td>English Certificate</td><td>{{ $application->english_certificate ? 'Yes' : 'No' }}</td></tr>
            <tr><td>Experience Year</td><td>{{ $application->experience_year ?? 'N/A' }} Years</td></tr>
            <tr><td>Video Link</td><td>{{ $application->video_link ?? 'N/A' }}</td></tr>
        </table>

        <div class="footer">
            &copy; {{ date('Y') }} BritFly Jobs. All Rights Reserved.
        </div>
    </div>

    <script>
        // পেজ লোড হওয়ার সাথে সাথে প্রিন্ট ডাইলগ ওপেন হবে
        window.onload = function() { window.print(); }
    </script>
</body>
</html>
