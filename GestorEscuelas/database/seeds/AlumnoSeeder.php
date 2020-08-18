<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');//Datos en Español
        for ($i=0; $i < 1000; $i++) 
        {
            \DB::table('Alumnos')->insert(array(
                'nombre' => 
                    $faker->firstName($faker->randomElement(['male','female'])),
                    //Generamos aletoriamente nombres masculinos o femeninos
                'apellidos' =>
                    $faker->lastName.' '.$faker->lastName,
                    //Generamos apellidos
                'fechaNacimiento' => 
                    $faker->datetimeBetween('-99 years','-15 years'),
                    //Generamos una fecha de nacimiento de alguien de entre 15 y 99 años
                'ciudad' => 
                    $faker->randomElement(['Barcelona','Tarragona','Lleida','Girona']),
                    //Asignamos al azar una ciudad de esas cuatro.
                'escuela_id' => 
                    $faker->numberBetween(1,50),
                    //Asignamos al azar una escuela de las 50 creadas por el seeder
                'created_at' => date('Y-m-d H:i:s'),
                    //Establecemos la fecha y hora actual
                'updated_at' => date('Y-m-d H:i:s')
                    //Establecemos la fecha y hora actual
            ));
        }
    }
}
