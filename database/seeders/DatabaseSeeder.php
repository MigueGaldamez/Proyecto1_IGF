<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Seeder;
use App\Models\TipoUsuario;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        TipoUsuario::create([
            'id'=>'1',
            'nombre'=>'cliente',
            'descripcion'=>'crear consultas',
        ]);
        TipoUsuario::create([
            'id'=>'2',
            'nombre'=>'Administrador',
            'descripcion'=>'Modificar tablas catalogo',
        ]);
        
        Especialidad::create([
            'id'=>'1',
            'nombre'=>'Especialidad en Derecho de sociedades',
            'descripcion'=>'Las relaciones de familia reconocidas por el Derecho Familiar son el matrimonio, el concubinato,
             el divorcio, la paternidad, la adopción, la patria potestad y la tutela.',
        ]);
        Especialidad::create([
            'id'=>'2',
            'nombre'=>'Especialidad en Derecho urbanístico',
            'descripcion'=>'Las relaciones de familia reconocidas por el Derecho Familiar son el matrimonio, 
            el concubinato, el divorcio, la paternidad, la adopción, la patria potestad y la tutela.',
        ]);
        

        User::factory(10)->create();
        $this->call([
            SalaChatSeeder::class
        ]);
    }
}
