<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ErrorApiController;
use App\Http\Controllers\Api\GameApiController;
use App\Http\Controllers\Api\HeroApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function ()
{
    Route::get('login', [AuthApiController::class, 'login']);
    Route::get('register', [AuthApiController::class, 'register']);
});

Route::middleware('auth:api')->group(function ()
{
    Route::prefix('games')->group(function ()
    {
        Route::get('/', [GameApiController::class, 'getList']);
        Route::get('{game_id}/heroes', [HeroApiController::class, 'getHeroesByGame']);
    });

    Route::prefix('heroes')->group(function ()
    {
        Route::post('create', [HeroApiController::class, 'createHero']);
        Route::get('{hero_id}', [HeroApiController::class, 'getHero']);
        Route::put('{hero_id}', [HeroApiController::class, 'updateHero']);
        Route::delete('{hero_id}', [HeroApiController::class, 'deleteHero']);
    });

    Route::get('logout', [AuthApiController::class, 'logout']);
});

Route::fallback([ErrorApiController::class, 'error']);
