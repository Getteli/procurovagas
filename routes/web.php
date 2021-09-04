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
    return view('content.welcome');
})->name("index");

Route::get('/como-funciona', function () {
    return view('content.comofunciona');
})->name("comofunciona");

Route::get('/criar-vaga', function () {
    return view('content.criarvaga');
})->name("criarvaga");

Route::get('/sobre', function () {
    return view('content.sobre');
})->name("sobre");

Route::get('/politica-e-privacidade', function () {
    return view('content.politicaeprivacidade');
})->name("politicaeprivacidade");