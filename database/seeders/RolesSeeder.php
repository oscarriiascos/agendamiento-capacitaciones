<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Crea los tipos de 
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'student']
        ]);
    }
}
