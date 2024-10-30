<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TestimoniController;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [DashboardController::class, 'home'])->name('dashboard');
Route::get('/about', [DashboardController::class, 'about'])->name('about');
Route::get('/contact', [DashboardController::class, 'contact'])->name('contact');
Route::get('/reservation', [DashboardController::class, 'reservation'])->name('reservation');
Route::get('/blog', [DashboardController::class, 'blog'])->name('blog');
Route::get('/menu', [DashboardController::class, 'menu'])->name('menu');
Route::get('/admin/register', [AdminController::class, 'register'])->name('register');
Route::post('/admin/register', [AdminController::class, 'register_proses'])->name('admin.register');
Route::get('/admin/login', [AdminController::class, 'login'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login_proses'])->name('admin.login');
// Route untuk dashboard admin
Route::middleware('auth:admin')->group(function() {
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('profile');
Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('password.update');

});
Route::get('/admin/data-admin', [AdminController::class, 'data_admin'])->name('data.admin');
Route::get('/admin/create', [AdminController::class, 'adminCreate'])->name('admin.tambah');
    Route::post('/admin', [AdminController::class, 'adminStore'])->name('admin.store');
    Route::get('/admin/{id}/edit', [AdminController::class, 'adminEdit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'adminUpdate'])->name('admin.update');
    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin/kontak', [AdminController::class, 'kontak'])->name('kontak');
Route::put('/admin/kontak/{id}', [AdminController::class, 'update_kontak'])->name('update.kontak');
Route::get('/admin/menu', [AdminController::class, 'menu'])->name('admin.menu');
Route::get('/admin/transaksi', [AdminController::class, 'transaksi'])->name('transaksi');
Route::get('/admin/tambah_menu', [AdminController::class, 'create'])->name('tambah.menu');
Route::post('/admin/menu', [AdminController::class, 'store'])->name('menu.store');
Route::get('/admin/edit_menu/{id}', [AdminController::class, 'edit'])->name('edit.menu');
Route::put('/admin/menu/{id}', [AdminController::class, 'update'])->name('menu.update');
Route::delete('/admin/hapus_menu/{id}', [AdminController::class, 'hapus_menu'])->name('hapus.menu');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('logout');
Route::get('/testimoni/create', [TestimoniController::class, 'create'])->name('testimoni.create');
Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
Route::get('/order/confirm/{id}', [OrderController::class, 'confirm'])->name('order.confirm');
Route::post('/order/process', [OrderController::class, 'process'])->name('order.process');
Route::get('/order/details/{id}', [OrderController::class, 'details'])->name('order.details');
Route::get('/order-success', [OrderController::class, 'orderSuccess'])->name('order.success');


Route::get('/order-success', [OrderController::class, 'orderSuccess'])->name('order.success');
Route::get('/order/continue/{id}', [PaymentController::class, 'continueTransaction'])->name('order.continue');

