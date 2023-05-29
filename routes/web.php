<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [FrontController::class, 'index'])
    ->name('home');
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::get('/app/login', [AuthController::class, 'logincustomer'])
    ->name('logincustomer');
Route::get('/destroy', [AuthController::class, 'destroy'])
    ->name('destroy');
Route::post('/loginstore', [AuthController::class, 'loginstore'])
    ->name('loginstore');
Route::post('/loginstorecustomer', [AuthController::class, 'loginstorecustomer'])
    ->name('loginstorecustomer');
Route::match(array('GET', 'POST'), '/app/register', [AuthController::class, 'register'])
    //->middleware('guest')
    ->name('register');
Route::match(array('GET', 'POST'), '/reset_password', [AuthController::class, 'reset_password'])
    ->name('reset_password');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/app/dashboard', [FrontController::class, 'dashboard'])
        ->name('app.dashboard');
    Route::match(array('GET', 'POST'),'/create/demande', [FrontController::class, 'adddemande'])
        ->name('adddemande');
    Route::match(array('GET', 'POST'),'/edit/demande/{id}', [FrontController::class, 'editdemande'])
        ->name('editdemande');
    Route::match(array('GET', 'POST'),'/app/saveprofil', [FrontController::class, 'saveprofil'])
        ->name('saveprofil');
    Route::match(array('GET', 'POST'),'/app/changepassword', [FrontController::class, 'changepassword'])
        ->name('changepassword');
});
Route::group(['middleware' => ['auth','isAdmin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');
});
Route::group(['prefix' => 'users', 'as' => 'users.'],function (){
    Route::match(array('GET', 'POST'), 'customer', [UserController::class, 'customer'])
        ->name('customer');
    Route::match(array('GET', 'POST'), 'technicien', [UserController::class, 'technicien'])
        ->name('technicien');
    Route::match(array('GET', 'POST'), 'administrateur', [UserController::class, 'administrateur'])
        ->name('administrateur');
    Route::get('/edit/{id}', [UserController::class, 'edit'])
        ->name('edit');
    Route::post('/update/{id}', [UserController::class, 'update'])
        ->name('update');
    Route::get('/list', [UserController::class, 'index'])
        ->name('index');
    Route::post('/store', [UserController::class, 'store'])
        ->name('store');
    Route::delete('/destroy', [UserController::class, 'destroy'])
        ->name('destroy');

});
Route::group(['prefix' => 'piecedetache', 'as' => 'piecedetache.'],function (){
    Route::match(array('GET', 'POST'), 'create', [PieceController::class, 'create'])
        ->name('create');
    Route::get('/edit/{id}', [PieceController::class, 'edit'])
        ->name('edit');
    Route::post('/update/{id}', [PieceController::class, 'update'])
        ->name('update');
    Route::get('/list', [PieceController::class, 'index'])
        ->name('index');
    Route::post('/store', [PieceController::class, 'store'])
        ->name('store');
    Route::delete('/destroy', [PieceController::class, 'destroy'])
        ->name('destroy');

});
Route::group(['prefix' => 'fiche', 'as' => 'fiche.'],function (){
    Route::match(array('GET', 'POST'), 'create/{id}', [FicheController::class, 'create'])
        ->name('create');
    Route::get('/edit/{id}', [FicheController::class, 'edit'])
        ->name('edit');
    Route::post('/update/{id}', [FicheController::class, 'update'])
        ->name('update');
    Route::get('/printdemande/{id}', [FicheController::class, 'printDemande'])
        ->name('printdemande');
    Route::get('/printfiche/{id}', [FicheController::class, 'printFiche'])
        ->name('printfiche');
    Route::get('/list', [FicheController::class, 'index'])
        ->name('index');
    Route::get('/depannage', [FicheController::class, 'depannage'])
        ->name('depannage');
    Route::post('/store', [FicheController::class, 'store'])
        ->name('store');
    Route::get('/addpieceline', [FicheController::class, 'addpieceline'])
        ->name('addpieceline');
    Route::delete('/destroy', [FicheController::class, 'destroy'])
        ->name('destroy');

});
Route::group(['prefix' => 'demande', 'as' => 'demande.'],function (){

    Route::get('/list', [DemandeController::class, 'index'])
        ->name('index');
    Route::get('/pending', [DemandeController::class, 'demandepending'])
        ->name('pending');
    Route::post('/store', [DemandeController::class, 'store'])
        ->name('store');
    Route::delete('/destroy', [DemandeController::class, 'destroy'])
        ->name('destroy');

});
