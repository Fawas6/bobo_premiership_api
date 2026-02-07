<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $adminRoleId = DB::table('roles')
            ->where('name', 'admin')
            ->value('id');

        DB::table('permissions')->updateOrInsert(
            [
                'name' => 'manage_players',
                'role_id' => $adminRoleId,
            ],
            [
                'description' => 'Admin can add and delete players',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
