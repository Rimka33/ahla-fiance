<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user {--email=admin@ahla.com} {--password=admin123} {--name=Admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un utilisateur administrateur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');
        $name = $this->option('name');

        // Validation
        $validator = Validator::make([
            'email' => $email,
            'password' => $password,
            'name' => $name,
        ], [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $this->error('Erreur de validation:');
            foreach ($validator->errors()->all() as $error) {
                $this->error('  - ' . $error);
            }
            return 1;
        }

        // Vérifier si l'utilisateur existe déjà
        if (User::where('email', $email)->exists()) {
            $this->error("Un utilisateur avec l'email '{$email}' existe déjà.");
            if ($this->confirm('Voulez-vous mettre à jour le mot de passe ?')) {
                $user = User::where('email', $email)->first();
                $user->password = Hash::make($password);
                $user->save();
                $this->info("Mot de passe mis à jour avec succès pour l'utilisateur '{$email}'.");
                return 0;
            }
            return 1;
        }

        // Créer l'utilisateur
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info("✅ Utilisateur admin créé avec succès !");
        $this->info("   Email: {$email}");
        $this->info("   Nom: {$name}");
        $this->info("");
        $this->info("Vous pouvez maintenant vous connecter à : http://127.0.0.1:8000/admin/login");

        return 0;
    }
}
