<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AccessTypesSeeder::class);

        User::create([
            'name' => 'Lullen Lullenium',
            'email' => '123',
            'password' => '123'
        ]);
    }
}
