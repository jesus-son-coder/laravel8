<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye !');
    }

    public function create()
    {
        return view('sessions.create');
    }


    public function store()
    {
        // Validate the request :
        $attributes = request()->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        // Attempt to authenticate and log in the User
        // based on the provided Credentials :
        if(! auth()->attempt($attributes)) {

            // Authentication failed :
            throw ValidationException::withMessages([
                'email' => 'Cet email n\'existe pas chez nous !'
            ]);

            /* Old méthode :
            return back()
                // les champs sont pré-ermplies des valeurs
                // précédemment saisies :
                ->withInput()
                // Transfert du message d'erreur à la vue :
                ->withErrors(['email' => 'Cet email n\'existe pas chez nous !' ]);
            */
        }

        // Se protéger de l'attaque "Session Fixation" :
        session()->regenerate();

        // Redirect to Homepage with a success Flesh message :
        return redirect('/profile')->with('success','Welcome back !');

    }


    public function profile()
    {
        return view('sessions.profile');
    }

}


