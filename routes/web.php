<?php

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

use Symfony\Component\HttpFoundation\Response;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/admin', function () {
    return view('/admin/dashboard');
})->name('admin_dashboard')->middleware(['auth', 'admin']);

Route::get('/admin/events', function () {
    return 'Admin Events';
})->name('admin_events')->middleware(['auth', 'admin']);

