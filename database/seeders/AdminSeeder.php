<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@smkcoding.sch.id'],
            [
                'name'     => 'Admin SMK Coding',
                'email'    => 'admin@smkcoding.sch.id',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
