<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();

        return view('admin.barang.index', compact('barang'));
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

        $barangTerakhir = Barang::orderByDesc('id_barang')->first();
        
        if ($barangTerakhir) {
            $nomor = $barangTerakhir->id_barang + 1;
        } else {
            $nomor = 1;
        }
        
        $data['kode_barang'] = 'B' . str_pad($nomor, 3, '0', STR_PAD_LEFT);

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