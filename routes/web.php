<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VinylController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\JoinController;
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('/vinyls', [VinylController::class, 'getVinyljos'])->name('vinyls.index');
    Route::post('/vinyls/search', [VinylController::class, 'index']);
    Route::get('/vinyls/trash', [VinylController::class, 'deletelist']);
    Route::post('/vinyls/trash/restore/{id}', [VinylController::class, 'restore']);
    Route::delete('/vinyls/trash/forcedelete/{id}', [VinylController::class, 'deleteforce']);

   
    Route::get('/vinyls/create',[VinylController::class, 'create']);
    Route::post('/vinyls/create',[VinylController::class, 'store']);

    Route::get('vinyls/edit/{id}', [VinylController::class, 'edit']);
    Route::post('/vinyls/edit/{id}', [VinylController::class, 'update']);
    Route::delete('/vinyls/delete/{id}', [VinylController::class,'destroy']);
    Route::get('vinyls/show/{id}', [VinylController::class, 'show']);


    Route::get('/penjuals', [PenjualController::class, 'getPenjuals'])->name('penjuals.index');
    Route::post('/penjuals/search', [PenjualController::class, 'index']);
    Route::get('/penjuals/trash', [PenjualController::class, 'deletelist']);
    Route::post('/penjuals/trash/restore/{id}', [PenjualController::class, 'restore']);
    Route::delete('/penjuals/trash/forcedelete/{id}', [PenjualController::class, 'deleteforce']);

   
    Route::get('/penjuals/create',[PenjualController::class, 'create']);
    Route::post('/penjuals/create',[PenjualController::class, 'store']);

    Route::get('penjuals/edit/{id}', [PenjualController::class, 'edit']);
    Route::post('/penjuals/edit/{id}', [PenjualController::class, 'update']);
    Route::delete('/penjuals/delete/{id}', [PenjualController::class,'destroy']);
    Route::get('penjuals/show/{id}', [PenjualController::class, 'show']);

    Route::get('/pembelis', [PembeliController::class, 'getPembelis'])->name('pembelis.index');
    Route::post('/pembelis/search', [PembeliController::class, 'index']);
    Route::get('/pembelis/trash', [PembeliController::class, 'deletelist']);
    Route::post('/pembelis/trash/restore/{id}', [PembeliController::class, 'restore']);
    Route::delete('/pembelis/trash/forcedelete/{id}', [PembeliController::class, 'deleteforce']);

   
    Route::get('/pembelis/create',[PembeliController::class, 'create']);
    Route::post('/pembelis/create',[PembeliController::class, 'store']);

    Route::get('pembelis/edit/{id}', [PembeliController::class, 'edit']);
    Route::post('/pembelis/edit/{id}', [PembeliController::class, 'update']);
    Route::delete('/pembelis/delete/{id}', [PembeliController::class,'destroy']);
    Route::get('pembelis/show/{id}', [PembeliController::class, 'show']);

    Route::get('/totals', [JoinController::class, 'index']);
    
});