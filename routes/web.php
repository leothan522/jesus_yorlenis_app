<?php

use Illuminate\Support\Facades\Route;
use SweetAlert2\Laravel\Swal;

Route::get('/', function () {
    // same as `Swal.fire()` in JS, same options: https://sweetalert2.github.io/#configuration
    Swal::toastSuccess([
        'showConfirmButton' => false,
        'title' => 'hola',
        'theme' => 'auto',
        'position' => 'top',
        'timer' => 3000,
    ]);
    return view('welcome');
})->name('web.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('dashboard');
    })->name('home');
});
