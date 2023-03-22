<?php

use App\Http\Controllers\ProfitController;
use App\Http\Controllers\TransactiondetailController;
use App\Http\Controllers\ReturnbookController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
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
        //------------------------user--------------------------------------
        Route::post('/insert-user', [UserController::class, 'store']);
        //------------------------employee----------------------------------
        Route::post('/insert-employee', [EmployeeController::class, 'store']);
        Route::put('/update-employee/{id}', [EmployeeController::class, 'update']);
        Route::get('/employee/{id}', [EmployeeController::class, 'show']);
        Route::get('/employee', [EmployeeController::class, 'index']);
        Route::delete('/delete-employee/{id}', [EmployeeController::class, 'destroy']);
        //------------------------customer-----------------------------------
        Route::post('/insert-customer', [CustomerController::class, 'store']);
        Route::put('/update-customer/{id}', [CustomerController::class, 'update']);
        Route::get('/customer/{id}', [CustomerController::class, 'show']);
        Route::get('/customer', [CustomerController::class, 'index']);
        Route::delete('/delete-customer/{id}', [CustomerController::class, 'destroy']);
        //------------------------rack----------------------------------------
        Route::post('/insert-rack', [RackController::class, 'store']);
        Route::put('/update-rack/{id}', [RackController::class, 'update']);
        Route::get('/rack/{id}', [RackController::class, 'show']);
        Route::get('/rack', [RackController::class, 'index']);
        Route::delete('/delete-rack/{id}', [RackController::class, 'destroy']);
        //---------------------------category------------------------------------------------
        Route::put('/update-category/{id}', [CategoryController::class, 'update']);
        Route::post('/get-category', [CategoryController::class, 'store']);
        Route::get('/category', [CategoryController::class, 'index']);
        Route::get('/category/{id}', [CategoryController::class, 'show']);
        Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);
        //---------------------------book------------------------------------------------------
        Route::post('/insert-book', [BookController::class, 'store']);
        Route::put('/update-book/{id}', [BookController::class, 'update']);
        Route::get('/book/{id}', [BookController::class, 'show']);
        Route::get('/book', [BookController::class, 'index']);
        Route::delete('/delete-book/{id}', [BookController::class, 'delete']);
        //---------------------------rent-----------------------------------------------------
        Route::post('/insert-rent', [RentController::class, 'store']);
        Route::put('/update-rent/{id}', [RentController::class, 'update']);
        Route::get('/rent/{id}', [RentController::class, 'show']);
        Route::get('/rent', [RentController::class, 'index']);
        Route::delete('/delete-rent/{id}', [RentController::class, 'delete']);
        //---------------------------return---------------------------------------------------
        Route::post('/insert-return', [ReturnbookController::class, 'store']);
        //---------------------------transaction------------------------------------------------
        Route::post('/insert-transaction', [TransactiondetailController::class, 'store']);

        Route::get('/profit-filter', [ProfitController::class, 'filter']);
    });

    Route::prefix('cashier')->middleware('cashier')->group(function () {
        //---------------------------Rent-------------------------------------------
        Route::post('/insert-rent', [RentController::class, 'store']);
        Route::put('/update-rent/{id}', [RentController::class, 'update']);
        Route::get('/rent/{id}', [RentController::class, 'show']);
        Route::get('/rent', [RentController::class, 'index']);
        Route::delete('/delete-rent/{id}', [RentController::class, 'delete']);

        //---------------------------Return-----------------------------------------
        Route::post('/insert-return', [ReturnbookController::class, 'store']);

        //----------------------------Transactiondetail----------------------------------------------
        Route::post('/insert-transaction', [TransactiondetailController::class, 'store']);
    });
});
Route::get('/', function () {
    return view('welcome');
});
