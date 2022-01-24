<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Users routes
 */

Route::post('register', [AuthController::class, 'registerUser']);
Route::post('login', [AuthController::class, 'loginUser']);
Route::post('login', [AuthController::class, 'deleteUser']);
Route::post('login', [AuthController::class, 'updateUser']);
