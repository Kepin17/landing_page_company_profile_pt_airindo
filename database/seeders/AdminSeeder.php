<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Delete existing admin accounts to avoid duplicates on re-seed
        User::where('email', 'admin@airindo.co.id')->delete();

        User::create([
            'name'              => 'Administrator',
            'email'             => 'admin@airindo.co.id',
            // Plain text — User model has 'hashed' cast, will auto-hash
            'password'          => 'admin123',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin account seeded: admin@airindo.co.id / admin123');
    }
}
