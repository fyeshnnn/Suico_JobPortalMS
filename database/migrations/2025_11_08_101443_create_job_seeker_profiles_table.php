<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_seeker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Personal Information
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            
            // Professional Information
            $table->string('headline')->nullable();
            $table->text('summary')->nullable();
            $table->string('current_position')->nullable();
            $table->string('current_company')->nullable();
            $table->string('industry')->nullable();
            $table->json('skills')->nullable();
            $table->string('experience_level')->nullable();
            $table->string('education_level')->nullable();
            
            // Resume/CV
            $table->string('resume_file_path')->nullable();
            $table->string('resume_original_name')->nullable();
            
            // Job Preferences
            $table->json('preferred_job_types')->nullable();
            $table->json('preferred_locations')->nullable();
            $table->decimal('expected_salary', 10, 2)->nullable();
            $table->string('salary_currency')->default('USD');
            
            // Social Links
            $table->string('linkedin_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->string('github_url')->nullable();
            
            // Profile Status
            $table->boolean('profile_visible')->default(true);
            $table->integer('profile_views')->default(0);
            $table->timestamp('last_profile_update')->nullable();
            
            $table->timestamps();
            
            // Keep only simple indexes (remove the composite ones for now)
            $table->index(['profile_visible']);
            $table->index(['experience_level']);
            $table->index(['industry']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_seeker_profiles');
    }
};