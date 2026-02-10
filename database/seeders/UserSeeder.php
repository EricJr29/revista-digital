<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Importante!
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'aluno',
                'email' => 'aluno@gmail.com',
                'password' => Hash::make('aluno123'),
                'foto' => null,
                'bio' => null,
                'permissao' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'professor',
                'email' => 'professor@gmail.com',
                'password' => Hash::make('professor123'),
                'foto' => null,
                'bio' => null,
                'permissao' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Aqui está a mágica: DB em vez de User::create
        DB::table('users')->insert($users);
    }
}