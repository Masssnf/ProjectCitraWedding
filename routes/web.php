<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CateringController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\DekorasiController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HiburanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MakeupController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TendaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WardrobeController;
use App\Models\Album;
use App\Models\Paket;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Mengambil semua data paket dari database
    $paket = Paket::all();

    // Mengirim variabel $paket ke view welcome
    return view('welcome', compact('paket'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', UserController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});

Route::resource('error', ErrorController::class);


Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::patch('/pembayaran/{id}/update-status', [PembayaranController::class, 'updateStatus'])->name('pembayaran.update-status');



Route::resource('laporan', LaporanController::class)->middleware('auth');
Route::resource('client', ClientController::class)->middleware('auth');
Route::resource('makeup', MakeupController::class)->middleware('auth');
Route::resource('events', EventsController::class)->middleware('auth');
Route::resource('album', AlbumController::class)->middleware('auth');
Route::resource('catering', CateringController::class)->middleware('auth');
Route::resource('tenda', TendaController::class)->middleware('auth');
Route::resource('dekorasi', DekorasiController::class)->middleware('auth');
Route::resource('paket', PaketController::class)->middleware('auth');
Route::resource('transaksi', TransaksiController::class)->middleware('auth');
Route::resource('wardrobe', WardrobeController::class)->middleware('auth');
Route::resource('pembayaran', PembayaranController::class)->middleware('auth');
Route::resource('hiburan', HiburanController::class)->middleware('auth');



require __DIR__ . '/auth.php';
