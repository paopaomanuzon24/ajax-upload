<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageUploadController;

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload-image', [ImageUploadController::class, 'store'])->name('image.upload');
