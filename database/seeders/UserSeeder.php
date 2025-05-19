<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(['name' => 'Maria Evan', 'email' => 'm.evam@gmail.com', 'password' => Hash::make('pass12'), 'role_id'=>1]);
        DB::table('users')->insert(['name' => 'Max Cai', 'email' => 'm.cai@outlook.com', 'password' => Hash::make('pass23'), 'role_id'=>1]);
        DB::table('users')->insert(['name' => 'Lorena White', 'email' => 'l.white@outlook.com', 'password' => Hash::make('pass34'), 'role_id'=>2]);
        DB::table('users')->insert(['name' => 'Cristhian Hasan', 'email' => 'c.hasan@gmail.com', 'password' => Hash::make('pass45'), 'role_id'=>1]);
        DB::table('users')->insert(['name' => 'Helen Uca', 'email' => 'h.uca@gmail.com', 'password' => Hash::make('pass56'), 'role_id'=>2]);
    }
}
