<?php

use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Models\Job;
use App\Models\JobApplication;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalJobs = Job::count();
    $totalApplications = JobApplication::count();

    return view('dashboard', compact('totalJobs', 'totalApplications'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('applications',JobApplicationController::class);
    Route::resource('jobs', JobController::class);
});

Route::get('/candidate_applications/status', [JobApplicationController::class, 'trackForm'])->name('applications.track.form');
Route::post('/track-application', [JobApplicationController::class, 'trackSearch'])->name('applications.track.search');
Route::get('/application/{id}/print', [JobApplicationController::class, 'printApplication'])->name('applications.print');
Route::get('/apply', [JobApplicationController::class, 'frontendCreate'])->name('applications.apply');
Route::post('/applications/frontend/store', [JobApplicationController::class, 'frontendStore'])->name('applications.frontend.store');
require __DIR__.'/auth.php';
