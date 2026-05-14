<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        // PERBAIKAN: Hanya gunakan 2 parameter (key pencarian, nilai default)
        $status = $request->query('status', 'all');

        $userLogin = Auth::user();

        $transaksis = Transaksi::query()
            // Filter berdasarkan status dropdown (Semua, DP, Lunas)
            ->when($status !== 'all', function ($query) use ($status) {
                $query->where('pembayaran', $status);
            })
            // PEMBATASAN ROLE: Jika yang login adalah CLIENT, tampilkan miliknya saja
            ->when($userLogin->role === 'CLIENT', function ($query) use ($userLogin) {
                $query->where('id_user', $userLogin->id);
            })
            ->with(['client', 'album', 'makeup', 'catering'])
            ->latest()
            ->paginate(10);

        // Pastikan Anda mem-passing variabel 'currentStatus' ke view agar tombol filternya menyala
        return view('page.pembayaran.index', [
            'transaksis' => $transaksis,
            'currentStatus' => $status
        ]);
    }

    // Update status pembayaran
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'jumlah_dibayar' => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Mencegah error jika inputan user lebih besar dari total tagihan
        // (Misal: Tagihan 5 juta, user input 6 juta karena salah ketik)
        $nominal_masuk = $request->jumlah_dibayar;
        if ($nominal_masuk > $transaksi->total_bayar) {
            $nominal_masuk = $transaksi->total_bayar;
        }

        // Simpan nominal yang diinput admin
        $transaksi->jumlah_dibayar = $nominal_masuk;

        // Logika otomatis penentuan status
        if ($transaksi->jumlah_dibayar >= $transaksi->total_bayar) {
            $transaksi->pembayaran = 'Lunas';
        } elseif ($transaksi->jumlah_dibayar > 0) {
            $transaksi->pembayaran = 'Dana Pertama';
        } else {
            $transaksi->pembayaran = 'Belum Bayar';
        }

        $transaksi->save();

        return redirect()->back()->with('success', 'Nominal pembayaran berhasil diverifikasi & diperbarui!');
    }
}
