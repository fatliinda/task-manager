<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Filament\Pages\TaskKanbanBoard;



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified',AdminMiddleware::class])
    ->name('dashboard');
    Route::get('/', function () {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect('/admin'); // Redirect to admin panel
            } else {
                return redirect('/app'); // Redirect to user dashboard
            }
        } else {
            return redirect('/app/login');
        }
    });

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__.'/auth.php';
