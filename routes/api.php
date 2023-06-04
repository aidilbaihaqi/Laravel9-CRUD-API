<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AuthController;
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

Route::post('v1/register', [AuthController::class, 'register'])->name('register');
Route::post('v1/login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:api')->group(function () {
  Route::apiResource('v1/articles', ArticleController::class);
  Route::apiResource('v1/categories', CategoryController::class);
  Route::post('v1/logout', [AuthController::class, 'logout'])->name('logout');
});
