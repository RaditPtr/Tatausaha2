<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\TblUserController;

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

// Testing Login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

Route::get('/home', function () {
    return redirect('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->middleware(['akses:tatausaha'])->group(function() {
        Route::get('/', [DashboardController::class, 'index']);
        // Route::get('/tambah', [DashboardController::class, 'create']);
        // Route::post('/simpan', [DashboardController::class, 'store']);
        // Route::delete('/hapus', [DashboardController::class, 'destroy']);
        // Route::get('/edit/{id}', [DashboardController::class, 'edit']);
        // Route::post('/edit/simpan', [DashboardController::class, 'update']);

        Route::middleware(['akses:tatausaha'])->group(function() {
            // Route untuk akun
            Route::prefix('/akun')->group(function() {
                Route::get('/', [TblUserController::class, 'index']);
                Route::get('/tambah', [TblUserController::class, 'create']);
                Route::post('/simpan', [TblUserController::class, 'store']);
                Route::get('/edit/{id}', [TblUserController::class, 'edit']);
                Route::post('/edit/simpan', [TblUserController::class, 'update']);
                Route::delete('/hapus', [TblUserController::class, 'destroy']);
            });

            // Route untuk guru
            Route::prefix('/guru')->group(function() {
                Route::get('/', [GuruController::class, 'index']);
                Route::get('/tambah', [GuruController::class, 'create']);
                Route::post('/simpan', [GuruController::class, 'store']);
                Route::get('/edit/{id}', [GuruController::class, 'edit']);
                Route::post('/edit/simpan', [GuruController::class, 'update']);
                Route::delete('/hapus', [GuruController::class, 'destroy']);
            });


            Route::prefix('/logs')->group(function() {
                Route::get('/', [LogsController::class, 'index']);
            });
        });
    });
    

    


    Route::get('/logout', [AuthController::class, 'logout']);
});

