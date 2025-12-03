<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Afficher le formulaire de modification du profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Mettre à jour le profil de l'utilisateur
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation des données
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'required_with:password'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ], [
            'name.required' => 'Le nom est requis.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'current_password.required_with' => 'Le mot de passe actuel est requis pour changer le mot de passe.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
        ]);

        // Vérifier le mot de passe actuel si un nouveau mot de passe est fourni
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])->withInput();
            }
        }

        // Mettre à jour le nom et l'email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Mettre à jour le mot de passe si fourni
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil mis à jour avec succès.');
    }
}

