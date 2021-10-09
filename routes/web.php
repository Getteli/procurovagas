<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CodesController;
use App\Http\Controllers\VagasController;
use App\Enum\TipoVaga;
use App\Enum\FormaTrabalho;
use App\Models\Vagas;

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
    $vagas = Vagas::listVagas();
    $tipoVaga = TipoVaga::class;
    return view('content.welcome', compact('vagas','tipoVaga'));
})->name("index");

Route::get('/como-funciona', function () {
    return view('content.comofunciona');
})->name("comofunciona");

Route::get('/criar-vaga', function () {
    $tipoVaga = TipoVaga::class;
    $formaTrabalho = FormaTrabalho::class;
    return view('content.criarvaga', compact('tipoVaga', 'formaTrabalho'));
})->name("criarvaga");

Route::get('/sobre', function () {
    return view('content.sobre');
})->name("sobre");

Route::get('/search', [VagasController::class, 'searchVaga'])->name('searchvaga.form');

// url-friendly
Route::get('/{slug}',[VagasController::class, 'getVaga'])->name("detail");

Route::get('/politica-e-privacidade', function () {
    return view('content.politicaeprivacidade');
})->name("politicaeprivacidade");

Route::post('/criar/vaga/manualmente', [VagasController::class, 'createManually'])->name('create.vaga.manually');

//
Route::get('/cnpj/{request}', [CodesController::class, 'cnpj']);