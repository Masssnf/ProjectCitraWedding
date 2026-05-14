<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Catering;
use App\Models\Client;
use App\Models\Makeup;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userLogin = Auth::user();

        // LOGIKA PEMBATASAN BERDASARKAN ROLE
        if ($userLogin->role === 'ADMIN' || $userLogin->role === 'OWNER') {
            // Jika Admin/Owner: Tarik SEMUA data transaksi
            $transaksi = Transaksi::latest()->paginate(10);
        } else {
            // Jika Client: Tarik data transaksi yang id_user-nya cocok dengan ID dia sendiri
            $transaksi = Transaksi::where('id_user', $userLogin->id)->latest()->paginate(10);
        }

        $paket = Paket::all();
        // Mengubah nama variabel dari $user menjadi $users agar tidak bentrok dengan $userLogin
        $users = User::all();
        $client = Client::all();

        return View('page.transaksi.index')->with([
            'transaksi' => $transaksi,
            'paket' => $paket,
            'user' => $users,
            'client' => $client,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paket = Paket::all();
        $user = User::all();
        $client = Client::all();
        $kode_invoice = Transaksi::createCode();

        return view('page.transaksi.create', compact('kode_invoice'))->with([
            'user' => $user,
            'paket' => $paket,
            'client' => $client,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. TAMBAHKAN VALIDASI UNTUK MENCEGAH ERROR SQL
        // Sistem akan mengecek apakah id_client dan id_paket terisi. 
        // Jika kosong, sistem akan otomatis mengembalikan user ke halaman form dengan pesan error.
        $request->validate([
            'kode_invoice'  => 'required',
            'id_client'     => 'required',
            'id_paket'      => 'required',
            'tanggal'       => 'required|date',
            'tanggal_acara' => 'required|date',
            'total_bayar'   => 'required|numeric',
        ], [
            // Pesan error khusus agar mudah dipahami
            'id_client.required' => 'Gagal menyimpan! Data Klien tidak boleh kosong. Jika Anda Klien, pastikan Admin telah mendaftarkan profil Anda.',
            'id_paket.required'  => 'Gagal menyimpan! Anda harus memilih Paket Layanan.',
        ]);

        // 2. SIMPAN DATA JIKA VALIDASI LOLOS
        Transaksi::create([
            'kode_invoice'  => $request->kode_invoice,
            'id_client'     => $request->id_client,
            'tanggal'       => $request->tanggal,
            'tanggal_acara' => $request->tanggal_acara,
            'id_paket'      => $request->id_paket,
            'total_bayar'   => $request->total_bayar,
            'id_user'       => Auth::id(),
        ]);3

        return redirect()->route('transaksi.index')->with('success', 'Transaksi / Booking Berhasil Ditambahkan!');
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
        $data = [
            'pembayaran' => $request->input('pembayaran'),
            'status' => $request->input('status'),
            // PENTING: 'id_user' Dihapus dari sini!
            // Jika admin update status, kita tidak boleh mengubah id_user menjadi ID admin.
            // Biarkan id_user tetap milik client yang pertama kali booking.
        ];

        $datas  = Transaksi::findOrFail($id);
        $datas->update($data);

        // Mengubah key menjadi 'success' agar cocok dengan flash message di UI Tailwind yang kita buat
        return redirect()->route('transaksi.index')->with('success', 'Status Transaksi berhasil di-update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Transaksi::findOrFail($id);
        $data->delete();

        // PENTING: Karena frontend memanggil delete menggunakan Axios (Javascript),
        // Kita harus mengembalikan response dalam bentuk JSON, bukan redirect back().
        return response()->json([
            'success' => true,
            'message' => 'Data transaksi berhasil dihapus'
        ]);
    }
}
