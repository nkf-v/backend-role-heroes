<?php

use App\Http\Controllers\Api\ErrorApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function ()
{
    Route::get('login', [AuthApiController::class, 'login']);
    Route::get('register', [AuthApiController::class, 'register']);
});

Route::middleware('auth:api')->group(function ()
{
    Route::get('games', [GameApiController::class, 'getList']);

    Route::get('logout', [AuthApiController::class, 'logout']);
});

Route::fallback([ErrorApiController::class, 'error']);
