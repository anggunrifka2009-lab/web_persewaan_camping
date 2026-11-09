<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $kategoriDipilih = $request->input('kategori');
        $cari = $request->input('cari');

        $kategori = Kategori::orderBy('nama_kategori')->get();

        $barang = Barang::with('kategori')
            ->where('status', 'tersedia')
            ->where('stok', '>', 0)

            ->when($kategoriDipilih, function ($query, $kategoriDipilih) {
                $query->where('id_kategori', $kategoriDipilih);
            })

            ->when($cari, function ($query, $cari) {
                $query->where('nama_barang', 'like', '%' . $cari . '%');
            })

            ->orderBy('nama_barang')
            ->get();

        return view('home', compact(
            'barang',
            'kategori',
            'kategoriDipilih',
            'cari'
        ));
    }

    public function show($id_barang)
    {
        $barang = Barang::with('kategori')
            ->where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->findOrFail($id_barang);

        return view('detail-barang', compact('barang'));
    }
}