<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicalSurveyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodSubmissionController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\Admin\FoodReviewController;
use App\Http\Controllers\AdminDashboardController;

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

// Public Routes
Route::get('/', function () {
    return view('index');
})->name('home');

// Test/Debug Routes (can be removed in production)
Route::get('/test-form', function() {
    return "Test form route works! Go to <a href='/survey'>/survey</a> or <a href='/checksurvey'>/checksurvey</a>";
});

Route::get('/test-store', function() {
    return "This is GET, your form uses POST. Check your form method.";
});

Route::get('/test-controller-show', [MedicalSurveyController::class, 'showSurvey']);
Route::get('/test-controller-report', [MedicalSurveyController::class, 'showReport']);

// Debug route (only one instance)
Route::get('/debug-dashboard', function() {
    $survey = \App\Models\MedicalSurvey::latest()->first();
    
    if (!$survey) {
        return "No survey found. Please complete a survey first at <a href='/checksurvey'>/checksurvey</a>";
    }
    
    // Debug the survey
    echo "<h2>Survey Data:</h2>";
    echo "<pre>";
    print_r($survey->toArray());
    echo "</pre>";
    
    // Create analytics
    $analytics = new \App\Services\MedicalAnalytics($survey);
    
    echo "<h2>Analytics Data:</h2>";
    echo "<pre>";
    echo "Risk Level: " . $analytics->getRiskLevel() . "\n";
    echo "Analytics class: " . get_class($analytics) . "\n";
    echo "</pre>";
    
    // Test if variables are passed correctly
    echo "<h2>Testing View:</h2>";
    
    try {
        return view('dashboard', [
            'survey' => $survey,
            'analytics' => $analytics,
            'reportData' => [
                'autoimmuneMatches' => $analytics->getAutoimmuneMatches(),
                'symptomSeverity' => $analytics->getSymptomSeverity(),
                'healthScores' => $analytics->getHealthScores(),
                'triggers' => $analytics->getTriggers(),
            ]
        ]);
    } catch (\Exception $e) {
        echo "<h3>Error in view:</h3>";
        echo "<pre>" . $e->getMessage() . "</pre>";
        echo "<p>File: " . $e->getFile() . "</p>";
        echo "<p>Line: " . $e->getLine() . "</p>";
    }
});

// Medical Survey Routes (accessible without auth if you want public submissions)
Route::get('/checksurvey', [MedicalSurveyController::class, 'showSurvey'])->name('checksurvey');
Route::get('/survey', [MedicalSurveyController::class, 'showSurvey'])->name('medical.survey');
Route::post('/survey', [MedicalSurveyController::class, 'store'])->name('medical.survey.store');
Route::get('/report', [MedicalSurveyController::class, 'showReport'])->name('medical.report');

// Authentication Required Routes
Route::middleware(['auth'])->group(function () {
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'smartDashboard'])
    ->middleware(['auth'])
    ->name('dashboard');
    
    // Medical Dashboard
    Route::get('/medical-dashboard', [DashboardController::class, 'showLatest'])
        ->name('medical.dashboard');
    
    Route::get('/medical-dashboard/{id}', [DashboardController::class, 'show'])
        ->name('medical.dashboard.show');
    
    // Services Page
    Route::get('/services', function () {
        return view('services');
    })->name('services');
    
    // Food Submission Routes
    Route::get('/food/upload', [FoodSubmissionController::class, 'create'])
        ->name('food.upload');
    
    Route::post('/food/upload', [FoodSubmissionController::class, 'store'])
        ->name('food.store');
    
    Route::get('/my-food-submissions', [FoodSubmissionController::class, 'mySubmissions'])
        ->name('food.submissions.mine');
    
    // Food Hub Routes
    Route::get('/food-hub', [FoodController::class, 'index'])->name('food.hub');
    Route::get('/food/{id}', [FoodController::class, 'show'])->name('food.show');
    Route::post('/food/{id}/like', [FoodController::class, 'like'])->name('food.like');
    Route::post('/food/{id}/save', [FoodController::class, 'save'])->name('food.save');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Admin Dashboard - Single definition
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    
    // Food Review Routes
    Route::get('/food-review', [FoodReviewController::class, 'index'])
        ->name('admin.food.review');
    
    Route::get('/food-submissions/{id}', [FoodReviewController::class, 'show'])
        ->name('admin.food.submissions.show');
    
    Route::post('/food-review/{id}/approve', [FoodReviewController::class, 'approve'])
        ->name('admin.food.approve');
    
    Route::post('/food-review/{id}/reject', [FoodReviewController::class, 'reject'])
        ->name('admin.food.reject');
});

// Authentication Routes (from auth.php)
require __DIR__.'/auth.php';