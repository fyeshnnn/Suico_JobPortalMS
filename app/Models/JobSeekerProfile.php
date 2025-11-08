<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'date_of_birth',
        'gender',
        'headline',
        'summary',
        'current_position',
        'current_company',
        'industry',
        'skills',
        'experience_level',
        'education_level',
        'resume_file_path',
        'resume_original_name',
        'preferred_job_types',
        'preferred_locations',
        'expected_salary',
        'salary_currency',
        'linkedin_url',
        'portfolio_url',
        'github_url',
        'profile_visible',
        'profile_views',
        'last_profile_update',
    ];

    protected $casts = [
        'skills' => 'array',
        'preferred_job_types' => 'array',
        'preferred_locations' => 'array',
        'date_of_birth' => 'date',
        'profile_visible' => 'boolean',
        'expected_salary' => 'decimal:2',
        'last_profile_update' => 'datetime',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get skills as array
     */
    public function getSkillsArrayAttribute(): array
    {
        return $this->skills ?? [];
    }

    /**
     * Get preferred job types as array
     */
    public function getPreferredJobTypesArrayAttribute(): array
    {
        return $this->preferred_job_types ?? [];
    }
}