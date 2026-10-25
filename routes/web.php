<?php

use App\Http\Controllers\ImagePdfController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/image-to-pdf', [
    ImagePdfController::class,
    'index',
])->name('image-to-pdf.index');

Route::post('/image-to-pdf/convert', [
    ImagePdfController::class,
    'convert',
])->name('image-to-pdf.convert');

Route::get('/pdf/merge', [PdfController::class, 'index'])
    ->name('pdf.merge');

Route::post('/pdf/merge', [PdfController::class, 'merge'])
    ->name('pdf.merge.process');

