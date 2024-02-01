<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Canciones;
class CancionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cancionesJson = file_get_contents('../laravel/canciones.json');
        $canciones = json_decode($cancionesJson, true);
        foreach ($canciones as $cancionesData) {
            Canciones::create([
                'id' => $cancionesData['id'],
                'nombre' => $cancionesData['nombre'],
                'artista' => $cancionesData['artista'],
                'url' => $cancionesData['url']          
            ]);
        }
    }
}
