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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // Role flags for our flexible system
            $table->boolean('is_job_seeker')->default(true);
            $table->boolean('is_employer')->default(false);
            $table->boolean('is_admin')->default(false);
            
            // Profile completion flags
            $table->boolean('profile_completed')->default(false);
            $table->timestamp('job_seeker_profile_completed_at')->nullable();
            $table->timestamp('employer_profile_completed_at')->nullable();
            
            // Account status
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};