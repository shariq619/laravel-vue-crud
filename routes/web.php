<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

//Auth::routes();



//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
