<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // use Carbon\Carbon;

    public function index()
    {
        // ==========================================
        // 1. CEK ROLE (SATAM PINTU DEPAN)
        // ==========================================
        $user = Auth::user();

        // Jika user adalah CLIENT, langsung lemparkan ke halaman katalog paket.
        // Fungsi ini akan berhenti di sini dan tidak melanjutkan kode di bawahnya.
        if ($user->role === 'CLIENT') {
            return redirect()->route('paket.index');
        }


        // ==========================================
        // 2. PERSIAPAN DATA DASHBOARD (KHUSUS ADMIN/OWNER)
        // ==========================================

        // Karena Client sudah dilempar ke tempat lain, kode di bawah ini 
        // dijamin hanya akan dieksekusi jika yang login adalah Admin/Owner.

        $totalBooking = Transaksi::count();
        $totalPembayaran = Transaksi::sum('total_bayar');
        $totalClient = Client::distinct('id')->count('id');
        $daftarTanggalAcara = Transaksi::orderBy('tanggal_acara', 'asc')->get();

        $now = Carbon::now();

        $acaraBulanIni = Transaksi::whereMonth('tanggal_acara', $now->month)
            ->whereYear('tanggal_acara', $now->year)
            ->with('client') // Load relasi client
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->tanggal_acara)->day;
            });

        $daysInMonth = $now->daysInMonth;
        $startDay = $now->startOfMonth()->dayOfWeek;

        // Ambil semua transaksi dengan relasi client dan format tanggal
        $daftarAcara = Transaksi::with('client')
            ->orderBy('tanggal_acara', 'asc')
            ->get()
            ->map(function ($transaksi) {
                $transaksi->formatted_date = Carbon::parse($transaksi->tanggal_acara)
                    ->translatedFormat('d F Y');
                return $transaksi;
            });

        // Render tampilan dashboard dan kirimkan data
        return view('dashboard', compact(
            'totalBooking',
            'totalClient',
            'daftarTanggalAcara',
            'now',
            'acaraBulanIni',
            'daysInMonth',
            'startDay',
            'daftarAcara',
            'totalPembayaran'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
