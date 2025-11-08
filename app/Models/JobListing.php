<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id', 'category_id', 'title', 'description', 'requirements',
        'job_type', 'experience_level', 'location', 'is_remote', 'salary_min',
        'salary_max', 'salary_currency', 'application_deadline', 'vacancies',
        'is_featured', 'is_active', 'views', 'application_count'
    ];

    protected $casts = [
        'application_deadline' => 'date',
        'is_remote' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function employerProfile()
    {
        return $this->hasOneThrough(
            EmployerProfile::class,
            User::class,
            'id', // Foreign key on users table
            'user_id', // Foreign key on employer_profiles table
            'employer_id', // Local key on job_listings table
            'id' // Local key on users table
        );
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
                    ->where('is_active', true)
                    ->where('application_deadline', '>=', now());
    }

    public function scopeLatest($query)
    {
        return $query->where('is_active', true)
                    ->where('application_deadline', '>=', now())
                    ->orderBy('created_at', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where('application_deadline', '>=', now());
    }

    public function getSalaryRangeAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return $this->salary_currency . ' ' . number_format($this->salary_min) . ' - ' . number_format($this->salary_max);
        } elseif ($this->salary_min) {
            return $this->salary_currency . ' ' . number_format($this->salary_min) . '+';
        } elseif ($this->salary_max) {
            return 'Up to ' . $this->salary_currency . ' ' . number_format($this->salary_max);
        }
        
        return 'Negotiable';
    }

    public function getIsNewAttribute()
    {
        return $this->created_at->gt(now()->subDays(3));
    }
}