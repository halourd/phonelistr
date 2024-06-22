<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneBookContactController;

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

Route::get('/contacts', [PhoneBookContactController::class, 'index']);
Route::get('/contacts/{id}', [PhoneBookContactController::class, 'show']);
Route::post('/contacts/create', [PhoneBookContactController::class, 'store']);
Route::put('/contacts/{phoneBookContact}', [PhoneBookContactController::class, 'update']);
Route::delete('/contacts/{phoneBookContact}', [PhoneBookContactController::class, 'destroy']);

// Route::apiResource('contacts', PhoneBookContactController::class);


