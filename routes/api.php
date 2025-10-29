<?php

use Illuminate\Support\Facades\Route;
use Modules\RAG\Http\Controllers\{
    RAGController,
    DocumentIngestionController,
};

Route::middleware(['auth:sanctum'])->prefix('rag')->group(function () {
    Route::post('ask', [RAGController::class, 'ask'])->name('rag.ask');
    Route::post('upload', [DocumentIngestionController::class, 'upload'])->name('rag.upload');
});

Route::middleware(['auth:sanctum'])->prefix('document')->group(function () {
    Route::get('/', [RAGController::class, 'index'])->name('document.index');
});
