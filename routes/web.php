<?php

use App\Http\Controllers\DesignPatternsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DesignPatternsController::class, 'main']);

Route::get('/design_pattern/{pattern}', [DesignPatternsController::class, 'designPattern']);

/**
 * Ajax request handling
 */
Route::post('/create', [DesignPatternsController::class, 'create']);

Route::post('/behave', [DesignPatternsController::class, 'behave']);
