<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Ingreso de usuario administrador para efectos de prueba
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@getnada.com',
                'is_admin' => true,
                'password' => Hash::make('adminpass'),
            ],
            [
                'name' => 'Estudiante #1',
                'email' => 'student_one@getnada.com',
                'is_admin' => false,
                'password' => Hash::make('student_one_pass'),
            ],
            [
                'name' => 'Estudiante #2',
                'email' => 'student_two@getnada.com',
                'is_admin' => false,
                'password' => Hash::make('student_two_pass'),
            ]
        ]);
            
    }
}
