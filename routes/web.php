<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest:masyarakat,petugas')->group(function () {
        Route::get('/login-masyarakat', 'halamanLoginMasyarkat')->name('halamanlogin.masyarakat');
        Route::post('/login-masyarakat', 'prosesLoginMasyarakat')->name('proses.login.masyarakat');

        Route::get('/login-petugas', 'halamanLoginPetugas')->name('halamanlogin.petugas');
        Route::post('/login-petugas', 'prosesLoginPetugas')->name('proses.login.petugas');
    });

    Route::get('/logout', 'logout')->middleware('auth:masyarakat,petugas')->name('logout');
});

Route::get('dash', function () {
    return "ini adalah dash";
})->middleware('auth:petugas,masyarakat');

Route::get('/users', function () {
    return [
        'masyarakat' => Auth::guard('masyarakat')->user(),
        'petugas' => Auth::guard('petugas')->user()
    ];
});

Route::get('/dashboard', function () {
    return "ini adalah halaman dashboard";
})->middleware(['coba:user']);
