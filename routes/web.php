<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DetailBeritaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\MentoringController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\UndanganController;


// Admin Login Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
Route::get('/admin/dashboard/chart-data', [AdminController::class, 'getAlumniChartData'])->name('admin.dashboard.chart-data')->middleware('auth:admin');
// Admin add user routes
Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create')->middleware('auth:admin');
Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store')->middleware('auth:admin');
Route::post('/admin/users/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete')->middleware('auth:admin');
Route::put('/admin/users/update', [AdminController::class, 'updateSiswa'])->name('siswa.update')->middleware('auth:admin');
Route::post('/admin/users/convert-to-alumni', [AdminController::class, 'convertToAlumni'])->name('admin.users.convert-to-alumni')->middleware('auth:admin');
// Admin pintar routes
Route::get('/admin/pintar', [AdminController::class, 'indexPerkembanganSekolah'])->name('admin.pintar.index');
Route::get('/admin/pintar/{id}', [AdminController::class, 'showPerkembanganSekolah'])->name('admin.pintar.show');
Route::post('/admin/pintar', [AdminController::class, 'storePerkembanganSekolah'])->name('admin.pintar.store')->middleware('auth:admin');
Route::put('/admin/pintar/{id}', [AdminController::class, 'updatePerkembanganSekolah'])->name('admin.pintar.update')->middleware('auth:admin');
Route::delete('/admin/pintar/{id}', [AdminController::class, 'destroyPerkembanganSekolah'])->name('admin.pintar.destroy')->middleware('auth:admin');

// Admin undangan routes
Route::get('/admin/undangan', [UndanganController::class, 'index'])->name('admin.undangan.index')->middleware('auth:admin');
Route::get('/admin/undangan/counts', [UndanganController::class, 'getCounts'])->name('admin.undangan.counts')->middleware('auth:admin');
Route::get('/admin/undangan/create', [UndanganController::class, 'create'])->name('admin.undangan.create')->middleware('auth:admin');
Route::post('/admin/undangan', [UndanganController::class, 'store'])->name('admin.undangan.store')->middleware('auth:admin');
Route::get('/admin/undangan/{undangan}', [UndanganController::class, 'show'])->name('admin.undangan.show')->middleware('auth:admin');
Route::get('/admin/undangan/{undangan}/edit', [UndanganController::class, 'edit'])->name('admin.undangan.edit')->middleware('auth:admin');
Route::put('/admin/undangan/{undangan}', [UndanganController::class, 'update'])->name('admin.undangan.update')->middleware('auth:admin');
Route::delete('/admin/undangan/{undangan}', [UndanganController::class, 'destroy'])->name('admin.undangan.destroy')->middleware('auth:admin');

// Download PDF route for undangan (accessible via notification)
Route::get('/undangan/{id}/download-pdf', [UndanganController::class, 'downloadPDF'])->name('undangan.download-pdf');

// Routes accessible only by alumni and siswa
Route::middleware(['auth:admin,alumni,siswa', 'log.auth.user', 'track.alumni.activity', 'track.siswa.activity'])->group(function () {
    Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy')->middleware(['auth:admin,alumni,siswa', 'log.auth.user']);
    Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
    Route::post('/lowongan', [LowonganController::class, 'store'])->name('lowongan.store');
    Route::get('/lowongan/{id}', [LowonganController::class, 'show'])->name('lowongan.show');
    Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy')->middleware(['auth:admin,alumni,siswa', 'log.auth.user']);
    Route::get('/donasi', [DonasiController::class, 'create'])->name('donasi.form');
    Route::get('/mentoring', [MentoringController::class, 'index'])->name('mentoring');
    Route::post('/mentoring/store', [MentoringController::class, 'store'])->name('mentoring.store');
    Route::get('/mentoring/{id}', [MentoringController::class, 'show'])->name('mentor.detail');
    Route::delete('/mentoring/{id}', [MentoringController::class, 'destroy'])->name('mentoring.destroy')->middleware(['auth:admin,alumni,siswa', 'log.auth.user']);
    Route::get('/forum', [ForumController::class, 'index'])->name('forum');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::post('/forum/reply/{topicId}', [ForumController::class, 'storeReply'])->name('forum.reply.store');
    Route::delete('/forum/{id}', [ForumController::class, 'destroy'])->name('forum.destroy')->middleware(['auth:admin,alumni,siswa', 'log.auth.user']);
    Route::get('/data-pengguna', [AlumniController::class, 'pengguna'])->name('data-pengguna');


    // Voucher
    Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher');
    Route::post('/voucher', [VoucherController::class, 'store'])->name('voucher.store');
    Route::get('/voucher/{voucher}', [VoucherController::class, 'show'])->name('voucher.show');
    Route::put('/voucher/{voucher}', [VoucherController::class, 'update'])->name('voucher.update');
    Route::delete('/voucher/{voucher}', [VoucherController::class, 'destroy'])->name('voucher.destroy');
    Route::get('/api/vouchers/active', [VoucherController::class, 'getActiveVouchers'])->name('vouchers.active');
    Route::post('/api/vouchers/use', [VoucherController::class, 'useVoucher'])->name('vouchers.use');
    Route::post('/notifications/read', [DashboardController::class, 'markNotificationsRead'])->name('notifications.read');
});

Route::get('/alumni/dashboard', function () {
    return redirect()->route('berita.index');
})->name('alumni.dashboard')->middleware('auth:alumni');

Route::get('/siswa/dashboard', function () {
    return redirect()->route('berita.index');
})->name('siswa.dashboard')->middleware('auth:siswa', 'track.siswa.activity');

//profil
Route::middleware(['auth:alumni,siswa,web', 'track.alumni.activity', 'track.siswa.activity'])->group(function () {
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('edit-profile');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('update-profile');
    Route::get('/profil/download-digital-card', [ProfilController::class, 'downloadDigitalCard'])->name('download-digital-card');
    Route::get('/profil/download-ijazah', [ProfilController::class, 'downloadIjazah'])->name('download-ijazah');

    // Password change routes
    Route::get('/change-password', [ProfilController::class, 'changePasswordForm'])->name('change-password.form');
    Route::post('/change-password', [ProfilController::class, 'updatePassword'])->name('change-password.update');
});

// Landingpage
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

// Testimoni
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
Route::delete('/testimoni/{id}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');

//donasi ADMIN
Route::get('/admin/donasi', [DonasiController::class, 'index'])->name('admin.donasi');
Route::get('/donasi', [DonasiController::class, 'create'])->name('donasi.form');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
Route::post('/admin/donasi/validate/{id}', [DonasiController::class, 'validateDonation'])->name('donasi.validate');
Route::post('/admin/donasi/reject/{id}', [DonasiController::class, 'rejectDonation'])->name('donasi.reject');
Route::post('/admin/donasi/penarikan', [DonasiController::class, 'storeWithdrawal'])->name('donasi.withdrawal')->middleware('auth:admin');
// ALUMNI
Route::get('/data-alumni', [AlumniController::class, 'index'])->name('data-alumni');
Route::post('/alumni/store', [AlumniController::class, 'store'])->name('alumni.store')->middleware('auth:admin,alumni,siswa');
Route::put('/alumni/update', [AlumniController::class, 'update'])->name('alumni.update')->middleware('auth:admin,alumni,siswa');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
