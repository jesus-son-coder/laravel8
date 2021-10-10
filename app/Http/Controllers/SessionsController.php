<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



class SessionsController extends Controller
{

  protected $redirectTo = RouteServiceProvider::HOME;

  protected function redirectTo()
  {
      return view('profile');
  }

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
            'email' => 'Les informations saisies ne sont pas correctes',
            'password' => 'Le mot de passe est incorrect'
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

  public function changePassword(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'oldpassword' => [
            'required', function($attribute, $value, $fail) {
                if(! Hash::check($value, Auth::user()->password)) {
                    return $fail(__('Le mot de passe est incorrect'));
                }
            },
            'min:8',
            'max:30'
        ],
        'newpassword' => 'required|min:8|max:30',
        'cnewpassword' => 'required|same:newpassword',
    ], [
        'oldpassword.required'=>'Le mot de passe actuel est obligatoire.',

        'newpassword.required'=>'Le nouveau mot de passe est obligatoire.',
        'newpassword.min'=>'Le mot de passe doit avoir au moins 3 caractères.',
        'newpassword.max'=>'Le nouveau mot doit avoir au plus 30 caractères.',

        'cnewpassword.required'=>'La confirmation du mot de passe est obligatoire.',
        'cnewpassword.same'=>'La confirmation du mot de passe doit correspondre au nouveau mot de passe.',
    ]);

    if(! $validator->passes() ) {
        return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
    } else {
        $update = User::find(Auth::user()->id)->update(['password'=>Hash::make($request->newpassword)]);

        if(! $update) {
            return response()->json(['status'=>0, 'msg'=>'Une erreur s\'est produite...veuillez recommencer !']);
        } else {
            return response()->json(['status'=>1, 'msg'=>'Votre mot de passe a été mis à jour avec succès !']);
        }
    }

  }

  public function showForgottenPassword()
  {
    return view('sessions.password-forgotten');
  }


  public function postForgottenPassword(Request $request)
  {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                // ? back()->with(['status' => __($status)])
                ? back()->with(['status' => "Nous avons envoyé par e-mail le lien de réinitialisation de votre mot de passe !"])
                : back()->withErrors(['email' => __($status)]);
  }


  public function resetPassword($token)
  {
    return view('sessions.password-reset', ['token' => $token]);
  }


  public function updatePassword(Request $request)
  {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
  }

}
