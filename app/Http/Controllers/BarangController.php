<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->cari;

        $barang = Barang::with('kategori')
            ->when($cari, function ($query, $cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('kode_barang', 'like', "%{$cari}%")
                        ->orWhere('nama_barang', 'like', "%{$cari}%");
                });
            })
            ->paginate(5)
            ->withQueryString();

        return view('admin.barang.index', compact('barang', 'cari'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('admin.barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'harga_sewa' => str_replace('.', '', $request->harga_sewa),
        ]);

        $data = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_barang' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga_sewa' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        $kategoriDipilih = Kategori::findOrFail($data['id_kategori']);

        $namaKategori = strtolower(trim($kategoriDipilih->nama_kategori));

        $prefixKategori = [
            'tenda' => 'TEN',
            'sleeping bag' => 'SB',
            'kompor' => 'KM',
            'carrier' => 'CR',
        ];

        $prefix = $prefixKategori[$namaKategori]
            ?? substr(
                preg_replace(
                    '/[^A-Z0-9]/',
                    '',
                    strtoupper($kategoriDipilih->nama_kategori)
                ),
                0,
                3
            );

        $kodeTerakhir = Barang::where('kode_barang', 'like', $prefix . '%')
            ->pluck('kode_barang');

        $nomor = $kodeTerakhir
            ->map(function ($kode) use ($prefix) {
                return (int) substr($kode, strlen($prefix));
            })
            ->max() + 1;

        $data['kode_barang'] = $prefix . str_pad($nomor, 3, '0', STR_PAD_LEFT);

        Barang::create($data);

        return redirect()->route('barang.index');
    }

    public function show(Barang $barang)
    {
        //
    }

    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();

        return view('admin.barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->merge([
            'harga_sewa' => str_replace('.', '', $request->harga_sewa),
        ]);

        $data = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_barang' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga_sewa' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        $barang->update($data);

        return redirect()->route('barang.index');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index');
    }
}