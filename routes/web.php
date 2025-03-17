<?php

use App\Http\Controllers\DesignPatternsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DesignPatternsController::class, 'welcome']);
