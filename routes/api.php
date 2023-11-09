<?php

use App\Http\Controllers\Api\POWController;
use App\Http\Controllers\UserController;
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

require __DIR__ . '/auth.php';

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'show'])
        ->name('user.show');
});
Route::post('/user/getAllInfo', [UserController::class, 'getAllInfo'])
        ->name('user.getAllInfo');

Route::middleware(['auth:api', 'verified'])->group(function () {
    Route::post('/user/update', [UserController::class, 'update'])
        ->name('user.update');
    
    

    Route::post('/pow/create', [POWController::class, 'create'])
        ->name('pow.create');
});
