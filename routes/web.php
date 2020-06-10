<?php

use Illuminate\Support\Facades\Route;

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
    return view('pages.home');
});

Route::get('/income', function () {
    return view('user.income');
})->name('dashboard')->middleware('auth');

Route::get('/expense', function () {
    return view('user.expense');
})->middleware('auth');

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/login', "ControllerLoginUser@showLogin")->name('showLogin')->middleware('guest');
Route::post('/login', "ControllerLoginUser@login")->name('login');

Route::post('/logout', "ControllerLoginUser@logout")->name('logout');

Route::post('/getdata', "ControllerGetdata@get")->name('getdata');