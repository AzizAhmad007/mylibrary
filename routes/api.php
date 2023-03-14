<?php

use App\Http\Controllers\ReturnbookController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/insert-employee', [EmployeeController::class, 'store']);
Route::put('/update-employee/{id}', [EmployeeController::class, 'update']);
Route::get('/employee/{id}', [EmployeeController::class, 'show']);
Route::get('/employee', [EmployeeController::class, 'index']);
Route::delete('/delete-employee/{id}', [EmployeeController::class, 'destroy']);

Route::post('/insert-customer', [CustomerController::class, 'store']);
Route::put('/update-customer/{id}', [CustomerController::class, 'update']);
Route::get('/customer/{id}', [CustomerController::class, 'show']);
Route::get('/customer', [CustomerController::class, 'index']);
Route::delete('/delete-customer/{id}', [CustomerController::class, 'destroy']);

Route::post('/insert-rack', [RackController::class, 'store']);
Route::put('/update-rack/{id}', [RackController::class, 'update']);
Route::get('/rack/{id}', [RackController::class, 'show']);
Route::get('/rack', [RackController::class, 'index']);
Route::delete('/delete-rack/{id}', [RackController::class, 'destroy']);

Route::post('/insert-category', [CategoryController::class, 'store']);
Route::put('/update-category/{id}', [CategoryController::class, 'update']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/category', [CategoryController::class, 'index']);
Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);

Route::post('/insert-book', [BookController::class, 'store']);
Route::put('/update-book/{id}', [BookController::class, 'update']);
Route::get('/book/{id}', [BookController::class, 'show']);
Route::get('/book', [BookController::class, 'index']);
Route::delete('/delete-book/{id}', [BookController::class, 'delete']);

Route::post('/insert-rent', [RentController::class, 'store']);
Route::put('/update-rent/{id}', [RentController::class, 'update']);
Route::get('/rent/{id}', [RentController::class, 'show']);
Route::get('/rent', [RentController::class, 'index']);
Route::delete('/delete-rent/{id}', [RentController::class, 'delete']);

Route::post('/insert-return', [ReturnbookController::class, 'store']);
