<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    // 1. Show all applications
    public function index()
    {
        $applications = JobApplication::with('job')->latest()->get();
        return view('applications.index', compact('applications'));
    }

    // 2. Show create form
    public function create()
    {
        $jobs = Job::where('status', 1)->get(); // শুধু এক্টিভ জবগুলো দেখাবে
        return view('applications.create', compact('jobs'));
    }

    public function frontendCreate()
    {
        $jobs = Job::where('status', 1)->get(); // শুধু এক্টিভ জবগুলো দেখাবে
        return view('applications.apply', compact('jobs'));
    }

    // 3. Store data
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date_of_birth' => 'nullable|date',
        ]);

        $data = $request->except('photo');

        // Photo Upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/applications'), $filename);
            $data['photo'] = 'uploads/applications/' . $filename;
        }

        // Default Status
        $data['status'] = $request->has('status') ? 1 : 0;

        // Created By (If Authenticated)
        $data['created_by'] = auth()->id();

        JobApplication::create($data);

        return redirect()->route('applications.index')->with('success', 'Application submitted successfully.');
    }

    public function frontendStore(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date_of_birth' => 'nullable|date',
        ]);

        $data = $request->except('photo');

        // Photo Upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/applications'), $filename);
            $data['photo'] = 'uploads/applications/' . $filename;
        }

        // Default Status
        $data['status'] = $request->has('status') ? 1 : 0;

        JobApplication::create($data);

        return redirect()->route('applications.apply')->with('success', 'Application submitted successfully.');
    }

    // 4. Show single application (Optional)
    public function show(JobApplication $application)
    {
        return view('applications.show', compact('application'));
    }

    // 5. Show edit form
    public function edit(JobApplication $application)
    {
        $jobs = Job::where('status', 1)->get();
        return view('applications.edit', compact('application', 'jobs'));
    }

    // 6. Update data
    public function update(Request $request, JobApplication $application)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('photo');

        // Update Photo
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($application->photo && file_exists(public_path($application->photo))) {
                unlink(public_path($application->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/applications'), $filename);
            $data['photo'] = 'uploads/applications/' . $filename;
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        $application->update($data);

        return redirect()->route('applications.index')->with('success', 'Application updated successfully.');
    }

    // 7. Delete data
    public function destroy(JobApplication $application)
    {
        // Delete photo from folder
        if ($application->photo && file_exists(public_path($application->photo))) {
            unlink(public_path($application->photo));
        }

        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
    }


    public function trackForm()
    {
        return view('applications.track');
    }

   public function trackSearch(Request $request)
{
    $request->validate([
        'phone' => 'required|string'
    ]);

    $searchPhone = preg_replace('/[^0-9]/', '', $request->phone);
    $possibleNumbers = [];
    $possibleNumbers[] = $searchPhone;
    if (str_starts_with($searchPhone, '0')) {
        $possibleNumbers[] = '880' . substr($searchPhone, 1);
    }
    if (str_starts_with($searchPhone, '880')) {

        $possibleNumbers[] = '0' . substr($searchPhone, 3);
    }


    $applications = JobApplication::with('job')
        ->where(function ($query) use ($possibleNumbers, $searchPhone) {
            foreach ($possibleNumbers as $number) {
                $query->orWhere('phone', $number);
            }
            $query->orWhere('phone', 'LIKE', '%' . $searchPhone);
        })
        ->latest()
        ->get();

    return view('applications.track', compact('applications'));
}

public function printApplication($id)
{
    $application = JobApplication::with('job')->findOrFail($id);
    return view('applications.print', compact('application'));
}

}
