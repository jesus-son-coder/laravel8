<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('homepage');
});


Route::get('/components', function () {
    return view('components-01');
});


Route::get('register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest')->name('userRegister');


Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest')->name('userLogin');;

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');;

Route::get('/profile', [SessionsController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('/update-profile-info', [SessionsController::class, 'updateInfo'])->middleware('auth')->name('updateProfileInfo');

Route::post('/change-profile-picture', [SessionsController::class, 'updatePicture'])->middleware('auth')->name('userPictureUpdate');

Route::post('change-password', [SessionsController::class, 'changePassword'])->middleware('auth')->name('userChangePassword');

Route::get('password-forgotten', [SessionsController::class, 'showForgottenPassword'])->middleware('guest')->name('password.request');

Route::post('password-forgotten', [SessionsController::class, 'postForgottenPassword'])->middleware('guest')->name('password.email');

Route::get('password-reset/{token}', [SessionsController::class, 'resetPassword'])->middleware('guest')->name('password.reset');

Route::post('password-reset', [SessionsController::class, 'updatePassword'])->middleware('guest')->name('password.update');

