<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categorias = [
            1 => 'Matemática',
            2 => 'Língua Portuguesa',
            3 => 'História',
            4 => 'Geografia',
            5 => 'Ciências',
            6 => 'Educação Física',
            7 => 'Artes',
            8 => 'Inglês',
        ];

        foreach ($categorias as $id => $nome) {
            Categoria::create([
                'id'   => $id,
                'nome' => $nome
            ]);
        }
    }
}
