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
        Schema::create('employer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Company Information
            $table->string('company_name');
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_postal_code')->nullable();
            
            // Company Details
            $table->string('company_website')->nullable();
            $table->text('company_description')->nullable();
            $table->string('company_industry')->nullable();
            $table->string('company_size')->nullable(); // 1-10, 11-50, 51-200, etc.
            $table->integer('founded_year')->nullable();
            $table->string('company_logo_path')->nullable();
            
            // Contact Person
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_position')->nullable();
            $table->string('contact_person_phone')->nullable();
            
            // Social Links
            $table->string('linkedin_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            
            // Verification
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->string('verification_document_path')->nullable();
            
            // Statistics
            $table->integer('total_jobs_posted')->default(0);
            $table->integer('active_jobs')->default(0);
            
            $table->timestamps();
            
            // Indexes
            $table->index(['company_name', 'is_verified']);
            $table->index(['company_industry', 'company_size']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_profiles');
    }
};