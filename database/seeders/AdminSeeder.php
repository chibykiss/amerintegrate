<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin;
        $admin->name = 'Gustavo Freeman';
        $admin->email = 'safeexpresscargos@gmail.com';
        $admin->password = Hash::make('12345678');
        $admin->save();
        Admin::create([
        'name' => 'vibe vibetek',
        'email' => 'vibetek@outlook.com',
        'admin_type' => 'super',
        'password' => Hash::make('12345678'),
        ]);
    }
}
