<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Asegúrate de importar el modelo User

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersJSON = file_get_contents('../laravel/users.json'); // Asegúrate de que la ruta al archivo JSON es correcta
        $users = json_decode($usersJSON, true);
        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt($userData['password']), // Asegúrate de encriptar la contraseña
                'role' => $userData['role'],
            ]);
        }
    }
}
