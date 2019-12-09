<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserción de los diferentes permisos
        if (DB::table('permissions')->get()->count() == 0) {
            /*
            DB::table('permissions')->insert([
                ['name' => "permiso.ejemplo1", 'guard_name' => 'web', 'created_at' => '2019-10-17 13:50:16', 'updated_at' => '2019-10-17 13:50:16']
                ['name' => "permiso.ejemplo2", 'guard_name' => 'web', 'created_at' => '2019-10-17 13:50:16', 'updated_at' => '2019-10-17 13:50:16']
            ]);
            */
        } else { echo "\e[31mTable permissions is not empty, therefore NOT "; }

        // Inserción de los diferentes roles
        if (DB::table('roles')->get()->count() == 0) {
            DB::table('roles')->insert([
                ['name' => 'Webmaster', 'guard_name' => 'web', 'created_at' => '2019-10-17 13:50:16', 'updated_at' => '2019-10-17 13:50:16'],
                ['name' => 'Recepcion', 'guard_name' => 'web', 'created_at' => '2019-10-17 13:50:16', 'updated_at' => '2019-10-17 13:50:16'],
                ['name' => 'Cliente', 'guard_name' => 'web', 'created_at' => '2019-10-17 13:50:16', 'updated_at' => '2019-10-17 13:50:16']
            ]);
        } else { echo "\e[31mTable roles is not empty, therefore NOT "; }

        // Inserción de varios permisos para los diferentes roles
        if (DB::table('role_has_permissions')->get()->count() == 0) {
            /*
            DB::table('role_has_permissions')->insert([
                ['permission_id' => 1, 'role_id' => 1],
                ['permission_id' => 2, 'role_id' => 1],
            ]);
            */
        } else { echo "\e[31mTable role_has_permissions is not empty, therefore NOT "; }
    }
}
