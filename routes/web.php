<?php

use App\Http\Controllers\DownloadMenuController;
use App\Http\Controllers\DownloadShoppingListController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/export/shopping-list', [DownloadShoppingListController::class, 'handle']);

Route::get('/export/menu', [DownloadMenuController::class, 'handle']);
