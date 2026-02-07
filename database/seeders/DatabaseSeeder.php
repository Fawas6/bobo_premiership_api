<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            PlayerSeeder::class
        ]);

        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL')],
            [
                'name' => 'Adeoye Fawas',
                'password' => bcrypt(env('ADMIN_PASSWORD')),
                'role_id' => env('ADMIN_ROLE_ID')
            ]
        );
    }
}
