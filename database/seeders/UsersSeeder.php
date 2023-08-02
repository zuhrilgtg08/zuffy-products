<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ahmad Zuhril Fahrizal',
            'username' => 'zuhrilKocak2023',
            'phone' => '089873239232',
            'email' => 'zuhril2023@gmail.com',
            'tgl_lahir' => null,
            'status_type' => 'admin',
            'job' => 'Staff Administrator',
            'image_profile' => null,
            'about_only' => null,
            'agama' => null,
            'password' => bcrypt('admin2023'),
        ]);

        User::create([
            'name' => 'Moch Fachrizal Zakaria',
            'username' => 'rijalBoy23',
            'phone' => '081253417220',
            'email' => 'rijalboy23@gmail.com',
            'tgl_lahir' => null,
            'status_type' => 'customer',
            'job' => 'Cleaning Service',
            'image_profile' => null,
            'about_only' => null,
            'agama' => null,
            'password' => bcrypt('rijalboy23'),
        ]);
    }
}
