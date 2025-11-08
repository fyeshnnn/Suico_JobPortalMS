<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'is_job_seeker',
        'is_employer',
        'is_admin',
        'profile_completed',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_job_seeker' => 'boolean',
            'is_employer' => 'boolean',
            'is_admin' => 'boolean',
            'profile_completed' => 'boolean',
        ];
    }

    /**
     * Get the user's full name
     */
    public function getFullNameAttribute(): string
    {
        return $this->middle_name 
            ? "{$this->first_name} {$this->middle_name} {$this->last_name}"
            : "{$this->first_name} {$this->last_name}";
    }

    /**
     * Check if user is a job seeker
     */
    public function isJobSeeker(): bool
    {
        return $this->is_job_seeker;
    }

    /**
     * Check if user is an employer
     */
    public function isEmployer(): bool
    {
        return $this->is_employer;
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Check if user has both roles
     */
    public function hasBothRoles(): bool
    {
        return $this->is_job_seeker && $this->is_employer;
    }

    /**
     * Activate job seeker role
     */
    public function activateJobSeekerRole(): void
    {
        $this->update(['is_job_seeker' => true]);
    }

    /**
     * Activate employer role
     */
    public function activateEmployerRole(): void
    {
        $this->update(['is_employer' => true]);
    }

    /**
     * Get the primary role for display purposes
     */
    public function getPrimaryRoleAttribute(): string
    {
        if ($this->is_admin) return 'Admin';
        if ($this->hasBothRoles()) return 'Job Seeker & Employer';
        if ($this->is_employer) return 'Employer';
        return 'Job Seeker';
    }

    /**
     * Get the job seeker profile associated with the user.
     */
    public function jobSeekerProfile()
    {
        return $this->hasOne(JobSeekerProfile::class);
    }

    /**
     * Get the employer profile associated with the user.
     */
    public function employerProfile()
    {
        return $this->hasOne(EmployerProfile::class);
    }

    /**
     * Check if user has completed job seeker profile
     */
    public function hasJobSeekerProfile(): bool
    {
        return $this->jobSeekerProfile !== null;
    }

    /**
     * Check if user has completed employer profile
     */
    public function hasEmployerProfile(): bool
    {
        return $this->employerProfile !== null;
    }
}