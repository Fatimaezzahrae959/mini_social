<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // afficher formulaire login
    public function showLogin()
    {
        return view('auth.login');
    }

    // afficher formulaire register
    public function showRegister()
    {
        return view('auth.register');
    }

    // traitement login
    public function login(Request $request)
    {

        // validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Veuillez entrer votre email',
            'email.email' => 'Format email invalide',
            'password.required' => 'Veuillez entrer votre mot de passe'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Utilisateur introuvable'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Mot de passe incorrect'])->withInput();
        }

        // stocker ID et nom en session
        session(['user_id' => $user->id, 'user_name' => $user->name]);

        return redirect('/posts');
    }

    // traitement register
    public function register(Request $request)
    {

        // validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Veuillez entrer votre nom',
            'email.required' => 'Veuillez entrer votre email',
            'email.email' => 'Format email invalide',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.required' => 'Veuillez entrer un mot de passe',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // auto login après register
        session(['user_id' => $user->id, 'user_name' => $user->name]);

        return redirect('/posts');
    }

    // logout
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}