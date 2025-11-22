<?php

use Illuminate\Support\Facades\Route;



Route::prefix('tasks')->group(function () {
    Route::get('/', fn() => view('tasks'))->name('tasks.index');
    Route::get('/create', fn() => view('tasks'))->name('tasks.create');
    Route::get('/edit/{id}', fn($id) => view('tasks', ['taskId' => $id]))->name('tasks.edit');
    Route::get('/delete/{id}', fn($id) => view('tasks', ['taskId' => $id]))->name('tasks.delete');
});


Route::prefix('')->group(function () {
    Route::get('/', fn() => view('users'))->name('users.index');
    Route::get('/create', fn() => view('users'))->name('users.create');
    Route::get('/edit/{id}', fn($id) => view('users', ['userId' => $id]))->name('users.edit');
    Route::get('/delete/{id}', fn($id) => view('users', ['userId' => $id]))->name('users.delete');
});
