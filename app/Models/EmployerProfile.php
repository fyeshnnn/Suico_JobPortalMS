<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'company_city',
        'company_state',
        'company_country',
        'company_postal_code',
        'company_website',
        'company_description',
        'company_industry',
        'company_size',
        'founded_year',
        'company_logo_path',
        'contact_person_name',
        'contact_person_position',
        'contact_person_phone',
        'linkedin_url',
        'facebook_url',
        'twitter_url',
        'is_verified',
        'verified_at',
        'verification_document_path',
        'total_jobs_posted',
        'active_jobs',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'founded_year' => 'integer',
        'total_jobs_posted' => 'integer',
        'active_jobs' => 'integer',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get full company address
     */
    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->company_address,
            $this->company_city,
            $this->company_state,
            $this->company_country,
            $this->company_postal_code
        ]);

        return implode(', ', $parts);
    }
}