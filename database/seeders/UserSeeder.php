<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        $password = '123456';
        User::create([

            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => 1,
            'password' =>  Hash::make($password),
        ]);

        User::create([

            'name' => 'Employee One',
            'email' => 'employeone@example.com',
            'role_id' => 2,
            'password' =>  Hash::make($password),
        ]);

        User::create([

            'name' => 'Employee Two',
            'email' => 'employetwo@example.com',
            'role_id' => 2,
            'password' =>  Hash::make($password),
        ]);


        User::create([

            'name' => 'Employee Three',
            'email' => 'employethree@example.com',
            'role_id' => 2,
            'password' =>  Hash::make($password),
        ]);

        User::create([

            'name' => 'Employee Four',
            'email' => 'employefour@example.com',
            'role_id' => 2,
            'password' =>  Hash::make($password),
        ]);


        User::create([

            'name' => 'Employee Five',
            'email' => 'employefive@example.com',
            'role_id' => 2,
            'password' =>  Hash::make($password),
        ]);

        User::create([

            'name' => 'Employee Six',
            'email' => 'employesix@example.com',
            'role_id' => 2,
            'password' =>  Hash::make($password),
        ]);


        User::create([

            'name' => 'Employee Seven',
            'email' => 'employeseven@example.com',
            'role_id' => 2,
            'password' =>  Hash::make($password),
        ]);
    }
}
