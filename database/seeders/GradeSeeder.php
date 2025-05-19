<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grades')->insert([
            [
                'name' => 'AAA',
                'description' => 'Highest quality with exceptional clarity, color, and cut.',
            ],
            [
                'name' => 'AA',
                'description' => 'High quality with very good clarity, color, and cut.',
            ],
            [
                'name' => 'A',
                'description' => 'Good quality with some visible inclusions or slight color variance.',
            ],
            [
                'name' => 'B',
                'description' => 'Average quality often used in commercial settings, may have noticeable inclusions.',
            ],
            [
                'name' => 'C',
                'description' => 'Below average quality with obvious inclusions and significant flaws.',
            ],
        ]);        
    }
}
