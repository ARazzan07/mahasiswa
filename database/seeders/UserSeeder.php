<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = [ 
            [
                'username'=>'admin',
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'level'=>'admin',
                'password'=>Hash::make('123456')
                ]
            ];
            foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
