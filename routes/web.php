<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Mail\getPassword;


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
    return view('welcome');
});

Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/post-register',[UserController::class,'validateForm'])->name('valid');
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/post-login',[UserController::class,'loginForm'])->name('auth');
Route::get('/home',[UserController::class,'home'])->name('home');
Route::get('/forgot',[UserController::class,'forgot'])->name('forgot');
Route::post('/forgotpassword',[UserController::class,'forgotpassword'])->name('forgotpassword');
Route::get('/sent',[UserController::class,'sent'])->name('sent');
Route::get('/setpassword/{email}',[UserController::class,'setpassword'])->name('setpassword');
Route::post('/newpassword',[UserController::class,'newpassword'])->name('newpassword');