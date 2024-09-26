<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = Storage::disk('local')->get('/json/role_users.json');
        $roleUsers = json_decode($json, true);

        foreach ($roleUsers as $roleUser) {
            // Verificar si el usuario existe
            $user = User::find($roleUser['user_id']);
            if ($user) {
                RoleUser::updateOrCreate(
                    ['user_id' => $roleUser['user_id'], 'role_id' => $roleUser['role_id']],
                    [
                        'role_id' => $roleUser['role_id'],
                        'user_id' => $roleUser['user_id']
                    ]
                );
            } else {
                // Opcionalmente, podrías crear el usuario aquí
                // User::create(['id' => $roleUser['user_id'], 'name' => 'Default Name', ...]);
            }
        }
    }
}
