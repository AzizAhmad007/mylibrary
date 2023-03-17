<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
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

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::prefix('logged')->middleware('auth')->group(function () {
    Route::post('/get-category', [CategoryController::class, 'store']);

    Route::prefix('admin')->middleware('admin')->group(function () {
        //---------------------------category------------------------------------------------
        Route::put('/update-category/{id}', [CategoryController::class, 'update']);
        Route::post('/get-category', [CategoryController::class, 'store']);
        Route::get('/category', [CategoryController::class, 'index']);
        Route::get('/category/{id}', [CategoryController::class, 'show']);
        Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);
    });
});
Route::get('/', function () {
    return view('welcome');
});
