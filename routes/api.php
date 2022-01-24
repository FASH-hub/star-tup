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
 * ------------------------------
 * Users routes
 * ------------------------------
 */

 //creates a new user
Route::post('register', [AuthController::class, 'registerUser']);

//login the user
Route::post('login', [AuthController::class, 'loginUser']);

// display all users
Route::get('user', [AuthController::class, 'displayUsers']);

// display user by id
Route::get('user/{id}', [AuthController::class, 'displayUsersId']);

// delete user
Route::delete('register/{id}', [AuthController::class, 'deleteUser']);

// update the user details
Route::patch('register/{id}', [AuthController::class, 'updateUser']);

// logout user
Route::post('logout', [AuthController::class, 'logout']);
