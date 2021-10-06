<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }


    // Creation of the User :
    public function store()
    {
        // dd(request()->all());

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        // dd('success validation succeed !');
        User::create($attributes);


        // session()->flash('success','Votre compte a bien été créé !');

        return redirect('/')->with('success','Votre compte a bien été créé !');

    }
}
