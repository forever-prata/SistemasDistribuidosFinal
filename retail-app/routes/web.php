<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Livewire\ProductIndex;
use App\Livewire\ProductCreate;
use App\Livewire\ProductEdit;

use App\Livewire\CustomerIndex;
use App\Livewire\CustomerCreate;
use App\Livewire\CustomerEdit;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/products', ProductIndex::class)->name('products.index');
    Route::get('/products/create', ProductCreate::class)->name('products.create');
    Route::get('/products/edit/{id}', ProductEdit::class)->name('products.edit');

    Route::get('/customers', CustomerIndex::class)->name('customers.index');
    Route::get('/customers/create', CustomerCreate::class)->name('customers.create');
    Route::get('/customers/edit/{id}', CustomerEdit::class)->name('customers.edit');
});

require __DIR__.'/auth.php';
