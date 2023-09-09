<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Otentikasi\OtentikasiController;
use App\Http\Controllers\PlayboxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['splade'])->group(function () {
    Route::get('/', fn () => view('home'))->name('home');
    Route::get('/docs', fn () => view('docs'))->name('docs');

    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    // auth
    Route::middleware(['auth', 'admin'])->group(function () {
        // about
        Route::get('/about/add', [AboutController::class, 'insertView'])->name('about.add');
        Route::get('/about/edit', [AboutController::class, 'editView'])->name('about.edit');
        Route::post('/about/insert/', [AboutController::class, 'insert'])->name('about.insert');
        Route::put('/about/update/{about}', [AboutController::class, 'update'])->name('about.update');
        Route::delete('/about/delete/{about}', [AboutController::class, 'delete'])->name('about.delete');

        // blog
        Route::get('/blog/add', [BlogController::class, 'create'])->name('blog.add');
        Route::get('/blog/edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
        Route::put('/blog/update/{blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/delete/{blog}', [BlogController::class, 'destroy'])->name('blog.delete');

        // playbox
        Route::get('/playbox/alquran/sinkron', [PlayboxController::class, 'Sinkron'])->name('alquran.sinkron');
    });
    Route::middleware(['auth'])->group(function () {
        // log out
        Route::get('/logout', [OtentikasiController::class, 'keluar'])->name('logout');
    });

    // masuk
    Route::get('/login', [OtentikasiController::class, 'masuk'])->name('masuk');
    // masuk otentikasi
    Route::post('/masuk/otentikasi', [OtentikasiController::class, 'masuk_otentikasi'])->name('otentikasi');

    // daftar
    Route::get('/register', [OtentikasiController::class, 'daftar'])->name('daftar');
    // daftar user
    Route::post('/register/post', [OtentikasiController::class, 'daftar_user'])->name('daftar.user');

    // home
    Route::get('/', [BerandaController::class, 'index'])->name('home');

    // about
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    // blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    // blog
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.detail');

    // playbox
    Route::get('/playbox', [PlayboxController::class, 'index'])->name('playbox');
    Route::get('/playbox/alquran', [PlayboxController::class, 'Alquran'])->name('alquran');
    Route::get('/playbox/alquran/{slug}', [PlayboxController::class, 'Alqurandetail'])->name('alquran.detail');
});
