<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [PublicController::class, 'landing'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/terms', [PublicController::class, 'terms'])->name('terms');
Route::get('/privacy', [PublicController::class, 'privacy'])->name('privacy');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/role/toggle', [DashboardController::class, 'toggleRole'])->name('dashboard.role.toggle');

// Employer Routes
Route::get('/employer/jobs', [EmployerController::class, 'jobs'])->name('employer.jobs');
Route::get('/employer/jobs/create', [EmployerController::class, 'create'])->name('employer.jobs.create');
Route::get('/employer/jobs/{job}', [EmployerController::class, 'show'])->name('employer.jobs.show');
Route::get('/employer/jobs/{job}/applicants', [EmployerController::class, 'applicants'])->name('employer.jobs.applicants');