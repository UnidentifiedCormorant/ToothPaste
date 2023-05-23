<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Complaint;
use App\Models\Pasta;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Artisan::call('orchid:admin Lullen_Lullenium admin@admin.com 123');

        Pasta::factory(50)->create();
        Pasta::factory(50)->create(['user_id' => 11]);

        Complaint::factory(10)->create();
    }
}
