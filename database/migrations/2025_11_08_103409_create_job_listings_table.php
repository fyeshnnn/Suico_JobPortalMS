<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->enum('job_type', ['full_time', 'part_time', 'contract', 'freelance', 'internship']);
            $table->enum('experience_level', ['entry', 'mid', 'senior', 'executive']);
            $table->string('location');
            $table->boolean('is_remote')->default(false);
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->string('salary_currency')->default('USD');
            $table->date('application_deadline');
            $table->integer('vacancies')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('views')->default(0);
            $table->integer('application_count')->default(0);
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['is_active', 'is_featured']);
            $table->index(['category_id', 'job_type']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};