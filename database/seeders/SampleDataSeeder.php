<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample categories
        $categories = [
            ['name' => 'Software Development', 'slug' => 'software-development', 'icon' => '💻'],
            ['name' => 'Web Development', 'slug' => 'web-development', 'icon' => '🌐'],
            ['name' => 'Mobile Development', 'slug' => 'mobile-development', 'icon' => '📱'],
            ['name' => 'Data Science', 'slug' => 'data-science', 'icon' => '📊'],
            ['name' => 'UI/UX Design', 'slug' => 'ui-ux-design', 'icon' => '🎨'],
            ['name' => 'Digital Marketing', 'slug' => 'digital-marketing', 'icon' => '📈'],
            ['name' => 'Project Management', 'slug' => 'project-management', 'icon' => '📋'],
            ['name' => 'Customer Support', 'slug' => 'customer-support', 'icon' => '🤝'],
            ['name' => 'Sales', 'slug' => 'sales', 'icon' => '💰'],
            ['name' => 'Human Resources', 'slug' => 'human-resources', 'icon' => '👥'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create sample employer
        $employer = User::create([
            'first_name' => 'Tech',
            'last_name' => 'Solutions Inc',
            'email' => 'employer@example.com',
            'password' => Hash::make('password'),
            'is_job_seeker' => false,
            'is_employer' => true,
        ]);

        // Create sample jobs
        $jobs = [
            [
                'employer_id' => $employer->id,
                'category_id' => Category::where('slug', 'software-development')->first()->id,
                'title' => 'Senior PHP Laravel Developer',
                'description' => 'We are looking for an experienced Laravel developer to join our team. You will be responsible for developing and maintaining web applications using Laravel framework.',
                'requirements' => 'PHP, Laravel, MySQL, JavaScript, REST APIs, Git',
                'job_type' => 'full_time',
                'experience_level' => 'senior',
                'location' => 'New York, NY',
                'is_remote' => true,
                'salary_min' => 80000,
                'salary_max' => 120000,
                'application_deadline' => now()->addDays(30),
                'is_featured' => true,
            ],
            [
                'employer_id' => $employer->id,
                'category_id' => Category::where('slug', 'web-development')->first()->id,
                'title' => 'Frontend React Developer',
                'description' => 'Join our frontend team to build amazing user experiences with React and modern web technologies.',
                'requirements' => 'React, JavaScript, HTML, CSS, TypeScript, Redux',
                'job_type' => 'full_time',
                'experience_level' => 'mid',
                'location' => 'San Francisco, CA',
                'is_remote' => false,
                'salary_min' => 70000,
                'salary_max' => 95000,
                'application_deadline' => now()->addDays(45),
                'is_featured' => true,
            ],
            [
                'employer_id' => $employer->id,
                'category_id' => Category::where('slug', 'mobile-development')->first()->id,
                'title' => 'Flutter Mobile Developer',
                'description' => 'Develop cross-platform mobile applications using Flutter and Dart for iOS and Android platforms.',
                'requirements' => 'Flutter, Dart, Firebase, REST APIs, Mobile Development',
                'job_type' => 'full_time',
                'experience_level' => 'mid',
                'location' => 'Austin, TX',
                'is_remote' => true,
                'salary_min' => 65000,
                'salary_max' => 90000,
                'application_deadline' => now()->addDays(20),
                'is_featured' => false,
            ],
            [
                'employer_id' => $employer->id,
                'category_id' => Category::where('slug', 'data-science')->first()->id,
                'title' => 'Data Scientist',
                'description' => 'Work with large datasets to extract insights and build predictive models using machine learning.',
                'requirements' => 'Python, SQL, Machine Learning, Statistics, Data Analysis',
                'job_type' => 'full_time',
                'experience_level' => 'senior',
                'location' => 'Boston, MA',
                'is_remote' => true,
                'salary_min' => 90000,
                'salary_max' => 130000,
                'application_deadline' => now()->addDays(25),
                'is_featured' => true,
            ],
            [
                'employer_id' => $employer->id,
                'category_id' => Category::where('slug', 'ui-ux-design')->first()->id,
                'title' => 'UI/UX Designer',
                'description' => 'Create beautiful and intuitive user interfaces for our web and mobile applications.',
                'requirements' => 'Figma, Adobe XD, User Research, Wireframing, Prototyping',
                'job_type' => 'full_time',
                'experience_level' => 'mid',
                'location' => 'Chicago, IL',
                'is_remote' => false,
                'salary_min' => 60000,
                'salary_max' => 85000,
                'application_deadline' => now()->addDays(15),
                'is_featured' => false,
            ],
        ];

        foreach ($jobs as $job) {
            JobListing::create($job);
        }

        // Update category job counts
        foreach (Category::all() as $category) {
            $category->update([
                'job_count' => $category->jobListings()->count()
            ]);
        }

        $this->command->info('Sample data seeded successfully!');
        $this->command->info('Employer login: employer@example.com / password');
    }
}