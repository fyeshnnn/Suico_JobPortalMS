<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'job_count', 'is_active'
    ];

    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}