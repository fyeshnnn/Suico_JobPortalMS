<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->text('cover_letter')->nullable();
            $table->string('resume_path')->nullable();
            $table->timestamps();
            
            $table->unique(['job_listing_id', 'user_id']); // Prevent duplicate applications
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};