<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        Kategori::create($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Request $request, Kategori $kategori)
    {
        $jumlahBarang = $kategori->barang()->count();

        if ($jumlahBarang > 0 && !$request->has('konfirmasi')) {
            return redirect()->route('admin.kategori.index')
                ->with('warning', [
                    'id_kategori' => $kategori->id_kategori,
                    'nama_kategori' => $kategori->nama_kategori,
                    'jumlah_barang' => $jumlahBarang,
                ]);
        }

        DB::transaction(function () use ($kategori) {
            $kategori->barang()->delete();
            $kategori->delete();
        });

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori dan seluruh barang di dalamnya berhasil dihapus.');
    }
}
