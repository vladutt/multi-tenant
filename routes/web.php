<?php

use App\Models\Database;
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

Route::get('/page/{any}', 'ApplicationController')->where('any', '.*');

Route::post('register', 'Auth\RegisterController@register');
Route::get('logout', 'Auth\LoginController@logout');
Route::post('login', 'Auth\LoginController@login');

Route::post('create-project', 'ProjectController@create');

Route::get('test', function() {
dd(Database::orderBy('users', 'ASC')->first());
    dd(\App\Models\Customer\Products::onProject('plmplmextra2')->get());

});
