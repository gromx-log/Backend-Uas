<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
        ]);
        
        $this->command->info('Seeding sukses');
        $this->command->info('User yang bisa langsung di test:');
        $this->command->info('Email: admin@gmail.com | Password: password123');
        $this->command->info('Email: mrfrelvang@gmail.com | Password: password123');
    }
}