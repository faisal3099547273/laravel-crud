<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RecycleController;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/recycle-bin', [RecycleController::class, 'index'])->name('recycle.index');
Route::post('/recycle-bin/restore', [RecycleController::class, 'restore'])->name('recycle.restore');
Route::post('/file/upload',[HomeController::class,'fileUpload'])->name('file.upload');
Route::resource('projects', ProjectController::class);