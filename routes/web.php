<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Головна сторінка (відображає всі блоги, випущені сьогодні або раніше)
Route::get('/', [BlogController::class, 'welcome'])->name('home');

// Ресурси для блогів 
Route::get('blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');


// Маршрути для авторизованих і перевірених користувачів
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Створення блогів
    Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('blogs', [BlogController::class, 'store'])->name('blogs.store');
    
    // Маршрут для перегляду всіх коментарів
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    
    // ДЛя сортування
    Route::get('/blogs/comments/{sort?}', [CommentController::class, 'index'])->name('blogs.comments');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    //редагування та видалення блогів
    Route::get('blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');

    Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});

// Маршрути для гостей
Route::middleware('guest')->group(function () {

    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'loginAuth'])->name('login.auth');

    Route::get('forgot-password', function () {
        return view('user.forgot-password');
    })->name('password.request');
    Route::post('forgot-password', [UserController::class, 'forgotPasswordStore'])->name('password.email')->middleware('throttle:3,1');
    Route::get('reset-password/{token}', function (string $token) {
        return view('user.reset-password', ['token' => $token]);
    })->name('password.reset');
    Route::post('reset-password', [UserController::class, 'resetPasswordUpdate'])->name('password.update');
});

// Можливо коментарів для гостей і авторизованих користувачів
Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');

// Верифікація для авторизованих користувачів
Route::middleware('auth')->group(function () {
    // Лінк для підтвердження електронної пошти
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:3,1')->name('verification.send');

    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});
