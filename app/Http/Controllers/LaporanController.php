<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPenyewaan = Penyewaan::count();

        $totalSelesai = Penyewaan::where(
            'status',
            'dikembalikan'
        )->count();

        $totalMenunggu = Penyewaan::where(
            'status',
            'menunggu'
        )->count();

        $totalDitolak = Penyewaan::where(
            'status',
            'ditolak'
        )->count();

        $totalPendapatan = Penyewaan::whereIn('status', [
            'dibayar',
            'dikembalikan',
        ])->sum('total_harga');

        $totalDenda = DB::table('pengembalian')->sum('denda');

        $penyewaan = Penyewaan::with([
            'user',
            'detailPenyewaan.barang',
        ])
            ->latest('id_penyewaan')
            ->paginate(10);

        $pengembalian = DB::table('pengembalian')
            ->whereIn(
                'id_penyewaan',
                $penyewaan->getCollection()->pluck('id_penyewaan')
            )
            ->get()
            ->keyBy('id_penyewaan');

        return view('admin.laporan.index', compact(
            'totalPenyewaan',
            'totalSelesai',
            'totalMenunggu',
            'totalDitolak',
            'totalPendapatan',
            'totalDenda',
            'penyewaan',
            'pengembalian'
        ));
    }
}