<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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


Route::get('/', [ContactController::class, 'index']);
Route::get('/contacts/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::get('/thanks', [ContactController::class, 'thanks'])->name('thanks');
Route::post('/contacts', [ContactController::class, 'store'])->name('store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('thanks');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

/*--------------------------管理者画面---------------*/

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

/*------------------登録者----------------------*/
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


/*--------------------------ログイン-----------------------*/
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
