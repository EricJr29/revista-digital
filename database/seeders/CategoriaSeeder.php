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
            'Matemática',
            'Língua Portuguesa',
            'História',
            'Geografia',
            'Ciências',
            'Educação Física',
            'Artes',
            'Inglês',
            'Eventos Escolares',
            'Avisos Gerais'
        ];

        foreach ($categorias as $c) {
            Categoria::create([
                'nome' => $c
            ]);
        }
    }
}
