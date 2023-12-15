<?php

namespace Database\Seeders;
use App\Models\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=[
            // 'name'=>'farhana',
            'email'=>'farhana2224u@gmail.com',
            'password'=>bcrypt('farhana')
        ];
        Admin::create($admin);
        //
    }
}
