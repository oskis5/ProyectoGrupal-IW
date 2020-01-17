<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                [
                    'email' => "franpial98@gmail.com",
                    'name' => "Webmaster",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59'
                ],
                [
                    'email' => "maria@gmail.com",
                    'name' => "Maria Lara",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ],
                [
                    'email' => "juan@gmail.com",
                    'name' => "Juan Almansa",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ],
                [
                    'email' => "pablo@gmail.com",
                    'name' => "Pablo Martínez",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ],
                [
                    'email' => "Alejandro@gmail.com",
                    'name' => "Alejandro Jiménez",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ], 
                [
                    'email' => "paula@gmail.com",
                    'name' => "Paula Fernandez",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ],
                [
                    'email' => "jose@gmail.com",
                    'name' => "Jose García",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ],
                [
                    'email' => "mario@gmail.com",
                    'name' => "Mario Torres",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ],
                [
                    'email' => "alicia@gmail.com",
                    'name' => "Alicia Alberola",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ],
                [
                    'email' => "carla@gmail.com",
                    'name' => "Carla Mena",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ],
                [
                    'email' => "fran@gmail.com",
                    'name' => "Fran",
                    'password' => '$2y$10$/Yo36AddyRY/LJq6ED7HH.B6ov8bCA2JsYEDDIVV7/hRfPJpBG7Ai',
                    'created_at' => '2019-10-15 09:20:59',
                    'updated_at' => '2019-10-15 09:20:59' 
                ],
            ]);
        } else { echo "\e[31mTable users is not empty, therefore NOT "; }

        if (DB::table('model_has_roles')->get()->count() == 0) {
            DB::table('model_has_roles')->insert([
                ['role_id' => 1, 'model_type' => 'App\User', 'model_id' => 1],
                ['role_id' => 2, 'model_type' => 'App\User', 'model_id' => 2],
                ['role_id' => 2, 'model_type' => 'App\User', 'model_id' => 3],
                ['role_id' => 2, 'model_type' => 'App\User', 'model_id' => 4],
                ['role_id' => 2, 'model_type' => 'App\User', 'model_id' => 5],
                ['role_id' => 2, 'model_type' => 'App\User', 'model_id' => 6],
                ['role_id' => 3, 'model_type' => 'App\User', 'model_id' => 7],
                ['role_id' => 3, 'model_type' => 'App\User', 'model_id' => 8],
                ['role_id' => 3, 'model_type' => 'App\User', 'model_id' => 9],
                ['role_id' => 3, 'model_type' => 'App\User', 'model_id' => 10],
                ['role_id' => 3, 'model_type' => 'App\User', 'model_id' => 11],
            ]);
        } else { echo "\e[31mTable model_has_roles is not empty, therefore NOT "; }
    }
}
