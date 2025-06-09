<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Supporting hash
use Illuminate\Support\Facades\Hash;

//Supporting Str
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'userId' => '1',
            'email' => 'test@example.com',
            'password' => Hash::make('blahblah'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'username' => 'testuser',
            'userHandle' => 'testuser123',
            'bio' => 'Test User',
            'followCount' => 0,
            'followedCount' => 0,
            'joined_at' => now(),
        ]);
    }
}
