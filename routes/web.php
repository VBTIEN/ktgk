<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\HocPhanController;
use App\Http\Controllers\DangKyController;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

Route::resource('sinh-viens', SinhVienController::class);
Route::resource('hoc-phans', HocPhanController::class);

Route::get('dang-ky/{ma_sv}', [DangKyController::class, 'create'])->name('dang-ky.create');
Route::post('dang-ky/them-gio-hang/{ma_sv}', [DangKyController::class, 'themVaoGioHang'])->name('dang-ky.them-gio-hang');
Route::delete('dang-ky/xoa-gio-hang/{ma_sv}/{ma_hp}', [DangKyController::class, 'xoaKhoiGioHang'])->name('dang-ky.xoa-gio-hang');
Route::post('dang-ky/luu/{ma_sv}', [DangKyController::class, 'luuDangKy'])->name('dang-ky.luu');

Route::get('dang-ky/danh-sach/{ma_sv}', [DangKyController::class, 'danhSach'])->name('dang-ky.danh-sach');
Route::delete('dang-ky/xoa/{ma_dk}/{ma_hp}', [DangKyController::class, 'xoaHocPhan'])->name('dang-ky.xoa-hoc-phan');
Route::delete('dang-ky/xoa-tat-ca/{ma_sv}', [DangKyController::class, 'xoaTatCa'])->name('dang-ky.xoa-tat-ca');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');