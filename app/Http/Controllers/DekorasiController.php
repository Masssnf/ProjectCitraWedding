<?php

namespace App\Http\Controllers;

use App\Models\Dekorasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DekorasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dekorasis = Dekorasi::latest()->paginate(5);
        return view('page.dekorasi.index', compact('dekorasis'));
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
        $request->validate([
            'type_dekorasi' => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'harga'         => 'required|numeric',
            'gambar'        => 'required|image|mimes:jpeg,png,jpg,webp|max:10240', // Wajib ada gambar, max 2MB
        ]);

        $data = $request->all();

        // Logika Upload Gambar Baru
        if ($request->hasFile('gambar')) {
            // Gambar akan disimpan di storage/app/public/dekorasi
            $data['gambar'] = $request->file('gambar')->store('dekorasi', 'public');
        }

        Dekorasi::create($data);

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('dekorasi.index')->with('success', 'Data Dekorasi berhasil ditambahkan!');
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
        $request->validate([
            'type_dekorasi' => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'harga'         => 'required|numeric',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', // Gambar opsional saat update
        ]);

        $dekorasi = Dekorasi::findOrFail($id);
        $data = $request->all();

        // Jika user mengunggah gambar baru di modal
        if ($request->hasFile('gambar')) {

            // 1. Hapus gambar lama dari server (jika ada)
            if ($dekorasi->gambar && Storage::disk('public')->exists($dekorasi->gambar)) {
                Storage::disk('public')->delete($dekorasi->gambar);
            }

            // 2. Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('dekorasi', 'public');
        }

        $dekorasi->update($data);

        return redirect()->route('dekorasi.index')->with('success', 'Data Dekorasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dekorasi = Dekorasi::findOrFail($id);

        // Hapus file gambar fisik dari server sebelum menghapus data dari database
        if ($dekorasi->gambar && Storage::disk('public')->exists($dekorasi->gambar)) {
            Storage::disk('public')->delete($dekorasi->gambar);
        }

        $dekorasi->delete();

        // Karena kita menggunakan Axios di Frontend, kita kembalikan respon JSON, bukan redirect
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
