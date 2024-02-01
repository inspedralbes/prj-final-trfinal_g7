<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorias;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriasJSON = file_get_contents('../laravel/categorias.json');
        $categorias = json_decode($categoriasJSON, true);
        foreach ($categorias['categorias'] as $categoriaData) {
            Categorias::create([
                'id' => $categoriaData['id'],
                'nombre' => $categoriaData['categoria'],
            ]);
        }
    }
}
