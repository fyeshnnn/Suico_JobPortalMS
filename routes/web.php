<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployerController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [PublicController::class, 'landing'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/terms', [PublicController::class, 'terms'])->name('terms');
Route::get('/privacy', [PublicController::class, 'privacy'])->name('privacy');

// Authentication Routes (Public)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');

// Protected Routes (Require Authentication)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard & Role Management
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/role/toggle', [DashboardController::class, 'toggleRole'])->name('dashboard.role.toggle');

    // Employer Routes
    Route::get('/employer/jobs', [EmployerController::class, 'jobs'])->name('employer.jobs');
    Route::get('/employer/jobs/create', [EmployerController::class, 'create'])->name('employer.jobs.create');
    Route::get('/employer/jobs/{job}', [EmployerController::class, 'show'])->name('employer.jobs.show');
    Route::get('/employer/jobs/{job}/applicants', [EmployerController::class, 'applicants'])->name('employer.jobs.applicants');

    // Profile & Account Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        // Main Profile
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        
        // Job Seeker Profile
        Route::put('/job-seeker', [ProfileController::class, 'updateJobSeekerProfile'])->name('update.job-seeker');
        Route::post('/resume', [ProfileController::class, 'uploadResume'])->name('resume.upload');
        Route::delete('/resume', [ProfileController::class, 'deleteResume'])->name('resume.delete');
        
        // Employer Profile  
        Route::put('/employer', [ProfileController::class, 'updateEmployerProfile'])->name('update.employer');
        Route::post('/company-logo', [ProfileController::class, 'uploadCompanyLogo'])->name('company-logo.upload');
        
        // Settings
        Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::put('/notifications', [ProfileController::class, 'updateNotifications'])->name('notifications.update');
        
        // Notifications
        Route::get('/notifications', [ProfileController::class, 'notifications'])->name('notifications');
        Route::post('/notifications/{id}/read', [ProfileController::class, 'markNotificationRead'])->name('notifications.read');
        Route::delete('/notifications', [ProfileController::class, 'clearNotifications'])->name('notifications.clear');
    });
});