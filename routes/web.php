<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Jalur menampilkan daftar tugas
Route::get('/tasks', [TaskController::class, 'index']);

// Jalur memproses tambah tugas baru
Route::post('/tasks', [TaskController::class, 'store']);

// Jalur memproses penyelesaian tugas (PATCH)
Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete']);

// Jalur memproses hapus tugas (DELETE)
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);