<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Ngebuat 10 user random
        for ($i = 0; $i < 10; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $username = strtolower($firstName . $lastName . rand(100, 999));
            $userHandle = strtolower($firstName . $lastName . rand(10, 99));
            
            // Cek agar username dan userHandle nya selalu unik
            while (DB::table('users')->where('username', $username)->exists()) {
                $username = strtolower($firstName . $lastName . rand(1000, 9999));
            }
            while (DB::table('users')->where('userHandle', $userHandle)->exists()) {
                $userHandle = strtolower($firstName . $lastName . rand(100, 999));
            }
            
            // Insert user ke database
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => $faker->optional(0.8)->dateTimeBetween('-1 year', 'now'),
                'password' => Hash::make('password123'), // Password sama (JANGAN DITIRU)!
                'username' => $username,
                'userHandle' => $userHandle,
                'bio' => $faker->optional(0.7)->realText(150),
                'followCount' => $faker->numberBetween(0, 500),
                'followedCount' => $faker->numberBetween(0, 300),
                'joined_at' => $faker->dateTimeBetween('-2 years', '-1 week'), // Antara 2 tahun terakhir sampai 1 minggu lalu
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // User unik yang udah ditentuin
        $testUsers = [
            [
                'email' => 'admin@gmail.com',
                'username' => 'Admin',
                'userHandle' => 'therealadmin27',
                'bio' => 'Atmin Datang',
            ],
            [
                'email' => 'mrfrelvang@gmail.com',
                'username' => 'Mr. Frelvang',
                'userHandle' => 'the_creator',
                'bio' => 'Creator & CEO | Coffee enthusiast | Dog lover',
            ]
        ];
        
        foreach ($testUsers as $user) {
            DB::table('users')->insert([
                'email' => $user['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Password sama (JANGAN DITIRU)!
                'username' => $user['username'],
                'userHandle' => $user['userHandle'],
                'bio' => $user['bio'],
                'followCount' => $faker->numberBetween(50, 200),
                'followedCount' => $faker->numberBetween(30, 150),
                'joined_at' => $faker->dateTimeBetween('-1 year', '-1 month'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}