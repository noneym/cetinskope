<?php

use App\Http\Controllers\SkinAnalysisController;
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

// Ana sayfa
Route::get('/', [SkinAnalysisController::class, 'index'])->name('home');

// Cilt analizi sonuç sayfası
Route::get('/cilt-analizi/{session_id}', [SkinAnalysisController::class, 'result'])->name('skin-analysis.result');

// PDF indirme
Route::get('/cilt-analizi/{session_id}/pdf', [SkinAnalysisController::class, 'downloadPdf'])->name('skin-analysis.pdf');
