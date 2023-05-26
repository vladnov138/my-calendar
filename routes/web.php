<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TaskController;

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

Route::get('/index', Controller::class)->name('home');
// Route::post('/index', [TaskController::class, 'findbydate'])->name('tasks.findbydate');
Route::get('/task/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/task/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/task/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::resource('tasks', TaskController::class);
