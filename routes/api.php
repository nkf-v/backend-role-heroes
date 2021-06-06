<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ErrorApiController;
use App\Http\Controllers\Api\GameApiController;
use App\Http\Controllers\Api\HeroApiController;
use App\Http\Controllers\Api\HeroAttributeApiController;
use App\Http\Controllers\Api\HeroCharacteristicApiController;
use App\Http\Controllers\Api\HeroStructuralAttributeApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function ()
{
    Route::get('check', [AuthApiController::class, 'check'])->name('login');
    Route::get('login', [AuthApiController::class, 'login']);
    Route::get('register', [AuthApiController::class, 'register']);
});

Route::middleware('auth:api')->group(function ()
{
    Route::prefix('games')->group(function ()
    {
        Route::get('/', [GameApiController::class, 'getList']);
        Route::get('{game_id}/heroes', [HeroApiController::class, 'getByGame']);
    });

    Route::prefix('heroes')->group(function ()
    {
        Route::post('create', [HeroApiController::class, 'create']);
        Route::get('{hero_id}', [HeroApiController::class, 'get']);
        Route::put('{hero_id}', [HeroApiController::class, 'updated']);
        Route::delete('{hero_id}', [HeroApiController::class, 'delete']);

        Route::put('{hero_id}/characteristics/{characteristic_id}/value', [HeroCharacteristicApiController::class, 'updateValue']);
        Route::put('{hero_id}/attributes/{attribute_id}/value', [HeroAttributeApiController::class, 'updateValue']);
        Route::put('{hero_id}/structural_attributes/{attribute_id}/value', [HeroStructuralAttributeApiController::class, 'updateValue']);
    });

    Route::get('logout', [AuthApiController::class, 'logout']);
    Route::get('auth/refresh', [AuthApiController::class, 'refresh']);
});

Route::fallback([ErrorApiController::class, 'error']);
