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


Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');


Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest')->name('login');;

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');;

Route::get('/profile', [SessionsController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('/update-profile-info', [SessionsController::class, 'updateInfo'])->middleware('auth')->name('updateProfileInfo');

Route::post('/change-profile-picture', [SessionsController::class, 'updatePicture'])->middleware('auth')->name('userPictureUpdate');
