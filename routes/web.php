<?php

use App\Http\Controllers\{
    UserController,
    KabupatenController,
    KecamatanController,
    KelurahanController,
    ProvinsiController,
    DashboardController,
};
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

Route::impersonate();

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'auth'
], function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('redirect_by_role');

    // Profil
    Route::get('user/profil', [UserController::class, 'showFormProfil'])->name('user.show_form_profil');
    Route::post('user/update_profil', [UserController::class, 'updateProfil'])->name('user.update_profil');
    Route::post('user/update_password', [UserController::class, 'updatePassword'])->name('user.update_password');
});
