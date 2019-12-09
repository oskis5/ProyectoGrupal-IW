<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();

        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();      

        $this->call([
            PermissionsTableSeeder::class,
            UsersTableSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
