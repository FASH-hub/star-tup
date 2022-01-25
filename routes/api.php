<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TchatController;

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

/**
 * ------------------------------
 * Tchats routes
 * ------------------------------
 */

// Displays all tchats
Route::get('tchat', [TchatController::class, 'index']);

//creates a new tchat
Route::post('tchat', [TchatController::class, 'create']);

//delete a tchat
Route::delete('tchat/{id}', [TchatController::class, 'destroy']);

//update a tchat
Route::patch('tchat/{id}', [TchatController::class, 'update']);



//Displays tchats by user
Route::get('tchat/{id}', [TchatController::class, 'displayChatByUser']);

//Displays user by tchat
Route::get('tchat/{id}', [TchatController::class, 'displayUserByChat']);

//
Route::post('linkedTchat/{id}', [ChatsController::class, 'attachUserTchat']);
//
Route::post('linkedUser/{id}', [ChatsController::class, 'attachTchatUser']);
