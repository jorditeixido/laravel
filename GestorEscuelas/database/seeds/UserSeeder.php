<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('Users')->insert(array(
            'name' => 
                'Administrador', 
                //Establecemos el nombre del Administrador
            'email' => 
                'admin@admin.com', 
                //Establecemos el email reseñado
            'email_verified_at' => 
                date("Y-m-d H:i:s"), 
                //Establecemos la hora actual
            'password' => Hash::make('password'), 
                //Establecemos la contraseña reseñada
            'created_at' => date("Y-m-d H:i:s"), 
            'updated_at' => date("Y-m-d H:i:s")
        ));
    }
}
