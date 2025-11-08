<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class FixUserRoles extends Command
{
    protected $signature = 'users:fix-roles';
    protected $description = 'Fix user roles for testing';

    public function handle()
    {
        $users = User::all();
        
        foreach ($users as $user) {
            $user->is_job_seeker = true;
            $user->is_employer = true;
            $user->save();
            $this->info("Updated user: {$user->email} - Job Seeker: Yes, Employer: Yes");
        }
        
        $this->info('All users now have both job seeker and employer roles.');
        return 0;
    }
}