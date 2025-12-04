<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicalSurveyController;
use Illuminate\Http\Request; // ✅ ADD THIS!

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

// FIXED: Only ONE route for '/'
Route::get('/', function () {
    return view('index'); // Changed from 'welcome' to 'index'
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ CORRECTED ROUTES:
// Option 1: Use /checksurvey OR /survey for the form (pick one)
Route::get('/checksurvey', [MedicalSurveyController::class, 'showSurvey'])->name('checksurvey');
// OR keep this if you want both URLs:
Route::get('/survey', [MedicalSurveyController::class, 'showSurvey'])->name('medical.survey');

// This is where your form submits to
Route::post('/survey', [MedicalSurveyController::class, 'store'])->name('medical.survey.store');

// This is where you get redirected after successful submission
Route::get('/report', [MedicalSurveyController::class, 'showReport'])->name('medical.report');

require __DIR__.'/auth.php';

// ✅ TEMPORARY TEST ROUTES (add these):
Route::get('/test-form', function() {
    return "Test form route works! Go to <a href='/survey'>/survey</a> or <a href='/checksurvey'>/checksurvey</a>";
});

Route::get('/test-store', function() {
    return "This is GET, your form uses POST. Check your form method.";
});

// Test if controller methods work
Route::get('/test-controller-show', [MedicalSurveyController::class, 'showSurvey']);
Route::get('/test-controller-report', [MedicalSurveyController::class, 'showReport']);