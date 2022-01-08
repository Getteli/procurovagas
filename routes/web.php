<?php

use App\Models\Vagas;
use App\Enum\TipoVaga;
use App\Cron\WebScrapper;
use App\Enum\FormaTrabalho;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodesController;
use App\Http\Controllers\VagasController;

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

/**
 * paginas
 */
Route::get('/', function () {
    $vagas = Vagas::listVagas();
    $tipoVaga = TipoVaga::class;
    return view('content.welcome', compact('vagas','tipoVaga'));
})->name("index");

Route::get('/politica-e-privacidade', function () {
    return view('content.politicaeprivacidade');
})->name("politicaeprivacidade");

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

Route::get('/testeemail', [VagasController::class, 'testeEmail'])->name('testeemail.get');


// metodo que faz o search na pagina principal
Route::get('/search', [VagasController::class, 'searchVaga'])->name('searchvaga.form');

/**
 * metodo que vai pegar as vagas via webscrapper p/ o banco
 */
Route::get('/webscrapper/vagas', [VagasController::class, 'getNewVagas'])->name('webscrapper.vagas');

/**
 * metodo que vai pegar as vagas no banco e verificar a data de tempo
 */
Route::get('/webscrapper/verify', [VagasController::class, 'verifyData'])->name('webscrapper.verify');


// url-friendly
Route::get('/{slug}',[VagasController::class, 'getVaga'])->name("detail");

// envia a vaga para o banco
Route::post('/criar/vaga/manualmente', [VagasController::class, 'createManually'])->name('create.vaga.manually');

// api de buscar dados do cnpj
Route::get('/cnpj/{request}', [CodesController::class, 'cnpj']);

// enviar via formulario sobre
Route::post('/send/form/about', [Controller::class, 'sendForm'])->name('send.form.about');

// envia o CV pela vaga
Route::post('/send/form/vaga', [VagasController::class, 'sendForm'])->name('send.form.vaga');