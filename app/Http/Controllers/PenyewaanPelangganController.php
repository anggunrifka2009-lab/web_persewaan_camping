<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penyewaan;
use App\Models\DetailPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PenyewaanPelangganController extends Controller
{
    public function create($id_barang)
    {
        abort_unless(Auth::user()->role === 'pelanggan', 403);

        $barang = Barang::with('kategori')
            ->where('status', 'tersedia')
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
        ]);

        $tanggalSewa = Carbon::parse($request->tanggal_sewa)->startOfDay();
        $tanggalKembali = Carbon::parse(
            $request->tanggal_rencana_kembali
        )->startOfDay();

        $lamaSewa = (int) $tanggalSewa->diffInDays($tanggalKembali);

        if ($lamaSewa > 7) {
            return back()
                ->withErrors([
                    'tanggal_rencana_kembali' =>
                        'Maksimal penyewaan adalah 7 hari.',
                ])
                ->withInput();
        }

        DB::transaction(function () use (
            $request,
            $id_barang,
            $tanggalSewa,
            $tanggalKembali,
            $lamaSewa
        ) {
            $barang = Barang::where('id_barang', $id_barang)
                ->lockForUpdate()
                ->firstOrFail();

            if ($barang->status !== 'tersedia' || $barang->stok < 1) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Barang sedang tidak tersedia.',
                ]);
            }

            $jumlah = (int) $request->jumlah;

            if ($jumlah > $barang->stok) {
                throw ValidationException::withMessages([
                    'jumlah' =>
                        'Jumlah barang melebihi stok yang tersedia.',
                ]);
            }

            $totalHarga = $barang->harga_sewa * $jumlah * $lamaSewa;

            $penyewaan = new Penyewaan();
            $penyewaan->kode_penyewaan =
                'SW-' . strtoupper(Str::random(8));
            $penyewaan->id_user = Auth::id();
            $penyewaan->tanggal_sewa = $tanggalSewa->toDateString();
            $penyewaan->tanggal_rencana_kembali =
                $tanggalKembali->toDateString();
            $penyewaan->total_harga = $totalHarga;
            $penyewaan->status = 'menunggu';
            $penyewaan->save();

            $detail = new DetailPenyewaan();
            $detail->id_penyewaan = $penyewaan->id_penyewaan;
            $detail->id_barang = $barang->id_barang;
            $detail->jumlah = $jumlah;
            $detail->harga_sewa = $barang->harga_sewa;
            $detail->subtotal = $totalHarga;
            $detail->save();
            $barang->stok -= $jumlah;
            $barang->save();
        });

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Penyewaan berhasil diajukan dan menunggu persetujuan admin.'
            );
    }

    public function riwayat()
    {
        abort_unless(Auth::user()->role === 'pelanggan', 403);

        $penyewaan = Penyewaan::with([
            'detailPenyewaan.barang',
        ])
            ->where('id_user', Auth::id())
            ->latest('id_penyewaan')
            ->paginate(5);

        return view(
            'pelanggan.penyewaan.riwayat',
            compact('penyewaan')
        );
    }
}