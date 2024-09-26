<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = Storage::disk('local')->get('/json/users.json');
        $users = json_decode($json, true);

        foreach($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // Condición de búsqueda para actualizar o crear
                [
                    'name' => $user['name'],
                    'apPaterno' => $user['apPaterno'],
                    'apMaterno' => $user['apMaterno'],
                    'celular' => $user['celular'],
                    'nacimiento' => $user['nacimiento'],
                    'password' => bcrypt($user['password']), // Encriptación de la contraseña
                ]
            );
        }
    }
}
