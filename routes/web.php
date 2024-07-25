<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;


Route::get('/', [UserController::class, 'home']);
Route::get('contact', [UserController::class, 'contact']);
Route::get('form', [UserController::class, 'form']);
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/form/store', [FormController::class, 'store'])->name('form.store');
Route::get('/show', [FormController::class, 'show'])->name('show');
Route::delete('/form-data/{id}', [FormController::class, 'destroy'])->name('form-data.destroy');
