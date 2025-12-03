<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si l'utilisateur admin existe déjà
        $admin = User::where('email', 'admin@ahla-finance.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'Administrateur',
                'email' => 'admin@ahla-finance.com',
                'password' => Hash::make('admin123@'),
                'email_verified_at' => now(),
            ]);

            $this->command->info('Utilisateur admin créé avec succès !');
            $this->command->info('Email: admin@ahla-finance.com');
            $this->command->info('Mot de passe: admin123@');
        } else {
            // Mettre à jour le mot de passe si l'utilisateur existe déjà
            $admin->update([
                'password' => Hash::make('admin123@'),
            ]);

            $this->command->info('Mot de passe de l\'utilisateur admin mis à jour !');
        }
    }
}

