<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// To secure this resource just need to put in above group middleware, where authentication is checked
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/most-conversion', [ReportController::class, 'mostConversion'])->name('report.most-conversion');
Route::get('/all-users-conversion', [ReportController::class, 'allUsersConversion'])->name('report.all-users-conversion');
Route::get('/third-highest-conversion/{userId}', [ReportController::class, 'thirdHighestConversion'])->name('report.third-highest-conversion');
