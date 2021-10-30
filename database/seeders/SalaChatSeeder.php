<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SalaChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('salaChat')->insert([
            'nombreSala'=>'General',
            
        ]);
        DB::table('salaChat')->insert([
            'nombreSala'=>'SalaMatrimonio',
            
        ]);
    }
}
