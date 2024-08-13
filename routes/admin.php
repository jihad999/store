<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth','verified'],
    'as' => 'admin.',
    'prefix' => 'admin',
],function(){
    Route::get('/', [AdminController::class,'index'])->name('index');
    Route::resource('/categories',CategoryController::class);
});

