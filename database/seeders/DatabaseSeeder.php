<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seeding the application's database.
     */
    public function run(): void
    {

        $this->call([
            GradeSeeder::class,
            GemstoneSeeder::class,
            UserSeeder::class
        ]);
    }
}
