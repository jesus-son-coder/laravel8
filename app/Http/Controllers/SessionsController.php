<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
    // $users = User::all();
    // dd($users);
    return view('sessions.create');
  }


  public function store(Request $request)
  {
      $attributes = request()->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required'
      ]);

      if (auth()->attempt($attributes)) {
        session()->regenerate();
        return redirect('/profile')->with('success', 'Welcome back !');

      } else {
          // Authentication failed :
          // throw new \Exception;
        throw ValidationException::withMessages([
            'email' => 'Cet email n\'existe pas chez nous !'
          ]);
      }


  }


  public function profile()
  {
    return view('sessions.profile');
  }


  public function updateInfo(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        // 'email' => 'required|email|unique:users,email,'. Auth::user()->id,
    ]);


    if($validator->fails()) {
        return response()->json(['status'=>0, 'error'=> $validator->errors()->toArray()]);
    } else {
        $query = User::find(Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if(!$query) {
            return response()->json(['status'=>0, 'msg'=> 'Something went wrong.']);
        } else {
            return response()->json(['status'=>1, 'msg'=> 'Votre profil a été mis à jour avec succès.']);
        }
    }

  }

  public function updatePicture(Request $request) {
    $path = 'images/users/';
    $file = $request->file('user_picture');
    // Génération d'un nom unique pour le fichier :
    $new_name = 'user_img_'.date('Ymd').uniqid() . '.jpg';

    // Upload new image :
    $upload = $file->move(public_path($path), $new_name);

    if(! $upload) {
        return response()->json(['status'=>0,'msg'=>'Une erreur s\'est produite...veuillez recommencer !']);
    } else {
        // Get Old Picture :
        $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

        if($oldPicture != '') {
            if(\File::exists(\public_path($path.$oldPicture))) {
                \File::delete(\public_path($path.$oldPicture));
            }
        }

        // Update DB :
        $update = User::find(Auth::user()->id)->update(['picture'=>$new_name]);

        if(! $upload) {
            return response()->json(['status'=>0,'msg'=>'Une erreur s\'est produite...veuillez recommencer !']);
        } else {
            return response()->json(['status'=>1, 'msg'=>'Votre image de profil a été mise à jour avec succès !']);
        }
    }

  }



}
