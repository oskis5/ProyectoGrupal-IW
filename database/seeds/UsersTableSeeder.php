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
            ]);
        } else { echo "\e[31mTable users is not empty, therefore NOT "; }

        if (DB::table('model_has_roles')->get()->count() == 0) {
            DB::table('model_has_roles')->insert([
                ['role_id' => 1, 'model_type' => 'App\User', 'model_id' => 1]
            ]);
        } else { echo "\e[31mTable model_has_roles is not empty, therefore NOT "; }
    }
}
