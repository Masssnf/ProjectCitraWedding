<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $clients = Client::paginate(3);
            return view('page.client.index', compact('clients'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. TAMBAHKAN VALIDASI BRAY!
        $request->validate([
            'namapl' => 'required',
            'namapr' => 'required',
            // Baris di bawah ini akan mengecek apakah email sudah ada di tabel users
            'email'  => 'required|email|unique:users,email',
        ], [
            // Pesan jika email sudah dipakai
            'email.unique' => 'Gagal menyimpan! Alamat email tersebut sudah dipakai oleh klien lain. Silakan gunakan email yang berbeda.',
        ]);

        // 2. BUAT AKUN USER
        $dataUser = [
            'name' => $request->input('namapl') . ' & ' . $request->input('namapr'),
            'email' => $request->input('email'),
            'password' => Hash::make('12345678'), // Password default
            'role' => 'CLIENT'
        ];

        $newUser = User::create($dataUser);

        // 3. BUAT PROFIL CLIENT
        $data = [
            'id_user' => $newUser->id, // <- Kunci Relasi
            'namapl' => $request->input('namapl'),
            'namapr' => $request->input('namapr'),
            'alamat' => $request->input('alamat'),
            'notelp' => $request->input('notelp'),
        ];

        Client::create($data);

        return back()->with('success', 'Data Client dan Akun Login Berhasil Dibuat!');
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
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'namapl' => $request->input('namapl'),
            'namapr' => $request->input('namapr'),
            'alamat' => $request->input('alamat'),
            'notelp' => $request->input('notelp'),
        ];

        $datas = Client::findOrFail($id);
        $datas->update($data);

        // Pesan sebelumnya "Sudah Dihapus", padahal ini update
        return back()->with('success', 'Data Profil Customer Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Client::findOrFail($id);

        // Hapus akun login (Users) yang terhubung dengan id_user klien ini
        if ($data->id_user) {
            User::where('id', $data->id_user)->delete();
        }

        // Baru hapus profil klien-nya
        $data->delete();

        return back()->with('success', 'Data Customer dan Akun Loginnya Sudah Dihapus');
    }
}
