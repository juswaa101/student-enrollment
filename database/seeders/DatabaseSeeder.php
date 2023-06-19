<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create admin account
        User::create([
            'name' => 'Administrator',
            'email' => 'administrator@mail.com',
            'email_verified_at' => now(),
            'password' => 'admin123',
            'remember_token' => Str::random(10),
            'is_admin' => 1,
        ]);

        // create students account
        $this->call(UserSeeder::class);

        // create subjects
        $this->call(SubjectSeeder::class);

        // create students enrolled subject
        $subjects = Subject::all();

        // populate the pivot table
        User::where('is_admin', 0)->each(function ($user) use ($subjects) {
            $user->subjects()->attach(
                $subjects->random(rand(12, 20))->pluck('id')->toArray()
            );
        });
    }
}
