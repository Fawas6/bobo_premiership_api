<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('players')->updateOrInsert(
            [
                'name' => 'Adeoye Fawas',
                'player_id' => 'Bobo-001'
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
