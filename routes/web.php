<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

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

Route::post('form_data',[AjaxController::class,'Ajax']);
Route::get('form_data/all',[AjaxController::class,'alldata']);
Route::get('form/edit/{id}',[AjaxController::class,'editData']);
Route::post('form_data/update/{id}',[AjaxController::class,'Update']);