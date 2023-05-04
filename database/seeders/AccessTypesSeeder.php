<?php

namespace Database\Seeders;

use App\Models\AccessType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccessType::insert([
            ['title' => 'public'],
            ['title' => 'unlisted'],
            ['title' => 'private'],
        ]);
    }
}
