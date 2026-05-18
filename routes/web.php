<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function ($locale) {

    if (! in_array($locale, ['en', 'bn'])) {
        abort(400);
    }

    session()->put('locale', $locale);

    return redirect()->back();

})->name('lang.switch');

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/auth/admin', function () {
    return view('auth.admin');
});