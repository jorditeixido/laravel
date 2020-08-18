<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');//Datos en Español
        for ($i=0; $i < 50; $i++) {
            \DB::table('Escuelas')->insert(array(
                'nombre' =>
                    $faker->randomElement(['Escuela','Academia','Centro','School'])
                        .' '.$faker->company,
                    //Concatemos un nombre simulando una Escuela
                'direccion'=>
                    $faker->address,
                    //generamos una dirección
                'logotipo' =>
                    'public/default_logotipo.jpg',
                    //Aplicamos un logotipo genérico
                'email' => 
                    $faker->email,
                    //Generamos un email
                'telefono' => 
                    $faker->numberBetween(601010101,698989898),
                    //Generamos un teléfono móvil aleatorio
                'paginaWeb' => 
                    'http://www.'.$faker->domainName,
                    //Generamos una URL para la web
                'created_at' => date('Y-m-d H:i:s'),
                    //Establecemos la fecha y hora actual
                'updated_at' => date('Y-m-d H:i:s')
                    //Establecemos la fecha y hora actual
            ));
        }
    }
}
