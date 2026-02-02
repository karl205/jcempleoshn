<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        $postulanteRoleId = DB::table('roles')
            ->where('name', 'postulante')
            ->value('id');

        $users = DB::table('users')->pluck('id');

        foreach ($users as $userId) {
            DB::table('user_roles')->updateOrInsert(
                [
                    'user_id' => $userId,
                    'role_id' => $postulanteRoleId
                ],
                []
            );
        }
    }
}
