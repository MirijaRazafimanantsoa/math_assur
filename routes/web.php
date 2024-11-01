<?php


 /* ato ny display an'ny pages hitan'ny user,
 
 ex: accueil, inscription,...*/

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ContratsController;
use App\Http\Controllers\SinistresController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AddClientController;
use App\Http\Controllers\DeleteClientController;
use App\Http\Controllers\CountsController;
use App\Http\Controllers\AddContratController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientsInContrats;

use Illuminate\Support\Facades\Route;

Route::get('/', [AccueilController::class, 'index'])->name('accueil.index');// rehefa tonga ao amle path / dia ataovy ilay foction index ao am dasboardcontroller
Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');
Route::get('/contrats', [ContratsController::class, 'index'])->name('contrats.index');
Route::get('/sinistres', [SinistresController::class, 'index'])->name('sinistres.index');
Route::get('/historique', [HistoriqueController::class, 'index'])->name('historique.index');
Route::post('/addclient', [AddClientController::class, 'store'])->name('client.add');
Route::delete('/addclient/{client_id}', [DeleteClientController::class, 'destroy'])->name('client.destroy');
Route::get('/dashboard-data', [CountsController::class, 'getCounts']);
Route::get('/client-info', [ContratsController::class, 'getinfo']);






Route::post('/addcontrat', [AddContratController::class, 'store'])->name('contrat.add');
Route::delete('/addcontrat/{client_id}', [AddContratController::class, 'destroy'])->name('contrats.destroy');
Route::get('/contrats/{num_contrat}/edit', [ContratsController::class, 'edit'])->name('contrat.edit');
Route::put('/contrats/{num_contrat}', [ContratsController::class, 'update'])->name('contrat.update');
Route::get('/contrats/{num_contrat}/details', [ContratsController::class, 'showDetails'])->name('detailsContrat');
Route::get('/clients/{client_id}/edit', [ClientsController::class, 'edit'])->name('client.edit');
Route::put('/clients/{client_id}', [ClientsController::class, 'update'])->name('client.update');
Route::post('/sinistres', [SinistresController::class, 'store'])->name('sinistres.store');
Route::get('/sinistres/declarer', [SinistresController::class, 'declare'])->name('declarerSinistre');


Route::get('/last-modifications', [HistoriqueController::class, 'getLastModifications']);
Route::get('/clients/{client_id}/details', [ClientsController::class, 'showDetails'])->name('detailsClient');
Route::get('/register', [UsersController::class,'register'])->name('register');
Route::post('/register', [UsersController::class,'store']);
Route::get('/login', [UsersController::class,'login'])->name('login');
Route::post('/login', [UsersController::class,'authenticate']);
Route::post('/logout', [UsersController::class,'logout'])->name('logout');


Route::get('/clients/search', [ClientsController::class, 'search'])->name('clients.search');

