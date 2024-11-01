<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function register(){
        return view('register');
    }

    public function store(){
        $validated = request()-> validate(
            [
                'name'=>'required|min:3|max:40',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|confirmed|min:6',
              'user_type' => 'required|in:administrateur,agent,consultant,client',  'user_type' => 'required|in:administrateur,agent,consultant,client',
            ]
            );

            User::create(
                [
                    'name'=>$validated['name'],
                    'email'=>$validated['email'],
                    'password'=>Hash::make($validated['password']),
                    'user_type'=>$validated['user_type'],
                ]
                );
                return redirect() -> route('accueil.index')->with('success', 'Compte créé avec succès');
    }

    public function login(){
        return view('login');
    }

    public function authenticate(){
        
        $validated = request()-> validate(
            [
                'name'=>'required|min:3|max:40',
                'password'=>'required|min:6',
            ]
            );


            if(Auth::attempt($validated)){
                request()->session()->regenerate();
                return redirect()->route('accueil.index')->with('success', 'Connecté avec succès');
            };

           
                return redirect() -> route('login')->withErrors([
                    'name'=>'Nom utilisateur ou mot de passe incorrect' 
                ]);
    }

    public function logout(){
        Auth::logout();
        request()->session()->regenerateToken();
        return redirect()->route('accueil.index')->with('success', 'Utilisateur déconnecté');

    }
}
