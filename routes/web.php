<?php

use App\Http\Controllers\DesignPatternsController;
use App\Http\Controllers\TargetClassController;
use App\Http\Controllers\VechicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DesignPatternsController::class, 'main']);

Route::get('/design_pattern/{pattern}', [DesignPatternsController::class, 'designPattern']);

Route::post('/create', [DesignPatternsController::class, 'create']);

Route::post('/behave', [DesignPatternsController::class, 'behave']);

// Route::post('/submit', function(Request $req, Response $res) {
//     $reqBody = $req->toArray();
//     dd($reqBody);
//     return $res->json([
//         'status' => 'success',
//         'message' => $req->all
//     ]);
// });