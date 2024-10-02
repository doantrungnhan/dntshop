<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\tagController;

Route::prefix('admin')->group(function () {
    Route::get('tag', [tagController::class, 'tag'])->name('tag');
    Route::get('create-tag', [tagController::class, 'create'])->name('tag.create');
    Route::post('store-tag', [tagController::class,'store'])->name('tag.store');
    Route::get('edit-tag/{id}', [tagController::class,'edit'])->name('tag.edit');
    Route::post('update-tag/{id}', [tagController::class,'update'])->name('tag.update');
    Route::delete('delete-tag/{id}', [tagController::class,'destroy'])->name('tag.destroy');
});
