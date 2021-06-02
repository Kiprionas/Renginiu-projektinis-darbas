<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\View_controller;
use App\Http\Controllers\Main_functions;

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

Route::get('/main/{city?}', [View_controller::class, 'show_main'])->name('main');

Route::get('/login', [View_controller::class, 'show_login'])->name('login');

Route::get('/register', [View_controller::class, 'show_register'])->name('register');

Route::get('/create', [View_controller::class, 'show_create'])->middleware(['auth', 'verified'])->name('create');

Route::get('/profile', [View_controller::class, 'show_profile'])->middleware(['auth', 'verified'])->name('profile');

Route::get('/profile/update', [View_controller::class, 'show_profile_update'])->middleware(['auth', 'verified'])->name('profile_update');

Route::get('logout', [Main_functions::class, 'logout_method']); 

Route::get('/test', [View_controller::class, 'show_test']);

Route::get('/private/{item?}', [View_controller::class, 'show_private']);

Route::get('/private/delete_event/{id}', [Main_functions::class, 'delete_event']);

Route::get('/private/delete_user/{id}', [Main_functions::class, 'delete_user']);

Route::get('/email/verify', [View_controller::class, 'show_email_verify'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [Main_functions::class, 'email_verify'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/post/{event_id}', [View_controller::class, 'show_post'])->middleware('auth', 'verified')->name('post');

Route::get('/post/update/{event_id}', [View_controller::class, 'show_update_post'])->middleware('auth', 'verified')->name('update_post');

Route::get('/post/buy/{id}', [Main_functions::class, 'buy_post_method'])->middleware('auth', 'verified');

Route::get('/forgot-password', [View_controller::class, 'show_forgot_password'])->middleware('guest')->name('passwrod.request');

Route::get('/reset_password/{token}', [View_controller::class, 'show_reset_password'])->middleware('guest')->name('password.reset');

Route::post('/reset_password', [Main_functions::class, 'reset_password_method'])->middleware('guest')->name('password.update');

Route::post('/forgot-password', [Main_functions::class, 'send_forgot_password_method'])->middleware('guest')->name('password.email');

Route::post('/email/send_verification', [Main_functions::class, 'send_verification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/login_method', [Main_functions::class, 'login_method']);

Route::post('/register_method', [Main_functions::class, 'register_method']);

Route::post('/create_method', [Main_functions::class, 'create_method']);

Route::post('test_method', [Main_functions::class, 'test_method']);

Route::post('/update_post/{event_id}', [Main_functions::class, 'update_post_method'])->middleware(['auth', 'verified']);