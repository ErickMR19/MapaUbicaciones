<?php

use Illuminate\Database\Seeder;

class DatosAppSantaAna extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('provincias')->insert([
            'id' => 1,
            'nombre' => 'San José',
        ]);
        DB::table('cantones')->insert([
            'nombre' => 'Santa Ana',
            'provincia_id' => '1'
        ]);
        DB::statement( 'SET SESSION SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";' );
        DB::table('Categories')->insert(
        [
            [
                'id' => 0,
                'descripcion' => 'Cultura',
            ], 
            [
                'id' => 1,
                'descripcion' => 'Deportes',
            ], 
            [
                'id' => 2,
                'descripcion' => 'Educación',
            ],
            [
                'id' => 3,
                'descripcion' => 'Salud',
            ], 
            [
                'id' => 4,
                'descripcion' => 'Bancos',
            ], 
            [
                'id' => 5,
                'descripcion' => 'Restaurantes',
            ],
            [
                'id' => 6,
                'descripcion' => 'Servicios Públicos',
            ],
            [
                'id' => 7,
                'descripcion' => 'Automotriz',
            ],
        ]
        );
          DB::table('Distritos')->insert(
        [
            [
                'nombre' => 'Santa Ana Centro',
                'canton_id' => '1'
            ], 
            [
                'nombre' => 'Salitral',
                'canton_id' => '1'
            ], 
            [
                'nombre' => 'Pozos',
                'canton_id' => '1'
            ],
            [
                'nombre' => 'La Uruca',
                'canton_id' => '1'
            ], 
            [
                'nombre' => 'Piedades',
                'canton_id' => '1'
            ], 
            [
                'nombre' => 'Brasil',
                'canton_id' => '1'
            ]
        ]
        );
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
