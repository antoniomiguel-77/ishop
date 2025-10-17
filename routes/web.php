<?php

use App\Livewire\Pages\Admin\Order;
use App\Livewire\Pages\Admin\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');




Route::middleware('auth')->group(function () {
    Route::get('utilizadores', User::class)->name('manager.users');
    Route::get('encomendas', Order::class)->name('manager.orders');
    Route::get('produtos', Order::class)->name('manager.products');
});

require __DIR__ . '/auth.php';
