<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penyewaan;
use App\Models\DetailPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PenyewaanPelangganController extends Controller
{
    public function create($id_barang)
    {
        abort_unless(Auth::user()->role === 'pelanggan', 403);

        $barang = Barang::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->findOrFail($id_barang);

        return view('pelanggan.penyewaan.create', compact('barang'));
    }

    public function store(Request $request, $id_barang)
    {
        abort_unless(Auth::user()->role === 'pelanggan', 403);

        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'tanggal_sewa' => 'required|date|after_or_equal:today',
            'tanggal_rencana_kembali' => 'required|date|after:tanggal_sewa',
            'jenis_pengambilan' => 'required|in:diambil,dikirim',
        ]);

        $tanggalSewa = Carbon::parse($request->tanggal_sewa);
        $tanggalKembali = Carbon::parse($request->tanggal_rencana_kembali);
        $lamaSewa = $tanggalSewa->diffInDays($tanggalKembali);

        if ($lamaSewa > 7) {
            return back()
                ->withErrors(['tanggal_rencana_kembali' => 'Maksimal penyewaan 7 hari.'])
                ->withInput();
        }

        $barang = Barang::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->findOrFail($id_barang);

        if ($request->jumlah > $barang->stok) {
            return back()
                ->withErrors(['jumlah' => 'Jumlah barang melebihi stok yang tersedia.'])
                ->withInput();
        }

        DB::transaction(function () use (
            $request,
            $barang,
            $tanggalSewa,
            $tanggalKembali,
            $lamaSewa
        ) {
            $totalHarga = $barang->harga_sewa * $request->jumlah * $lamaSewa;

            $penyewaan = new Penyewaan();
            $penyewaan->kode_penyewaan = 'SW-' . strtoupper(Str::random(8));
            $penyewaan->id_user = Auth::id();
            $penyewaan->tanggal_sewa = $tanggalSewa;
            $penyewaan->tanggal_rencana_kembali = $tanggalKembali;
            $penyewaan->total_harga = $totalHarga;
            $penyewaan->jenis_pengambilan = $request->jenis_pengambilan;
            $penyewaan->status = 'menunggu';
            $penyewaan->save();

            $detail = new DetailPenyewaan();
            $detail->id_penyewaan = $penyewaan->id_penyewaan;
            $detail->id_barang = $barang->id_barang;
            $detail->jumlah = $request->jumlah;
            $detail->harga_sewa = $barang->harga_sewa;
            $detail->subtotal = $totalHarga;
            $detail->save();
        });

        return redirect()
            ->route('home')
            ->with('success', 'Penyewaan berhasil diajukan dan menunggu persetujuan admin.');
    }

    public function riwayat()
    {
        abort_unless(auth()->user()->role === 'pelanggan', 403);
        
        $penyewaan = Penyewaan::where('id_user', auth()->id())
            ->latest('id_penyewaan')
            ->paginate(5);
            
        return view('pelanggan.penyewaan.riwayat', compact('penyewaan'));
        
    }
}
