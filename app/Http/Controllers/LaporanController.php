<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $totalPenyewaan = Penyewaan::count();

        $totalSelesai = Penyewaan::where('status', 'dikembalikan')->count();

        $totalMenunggu = Penyewaan::where('status', 'menunggu')->count();

        $totalDitolak = Penyewaan::where('status', 'ditolak')->count();

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
            ->paginate(7)
            ->withQueryString();

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

    public function cetakPdf()
    {
        $totalPenyewaan = Penyewaan::count();

        $totalSelesai = Penyewaan::where('status', 'dikembalikan')->count();

        $totalMenunggu = Penyewaan::where('status', 'menunggu')->count();

        $totalDitolak = Penyewaan::where('status', 'ditolak')->count();

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
            ->get();

        $pengembalian = DB::table('pengembalian')
            ->whereIn('id_penyewaan', $penyewaan->pluck('id_penyewaan'))
            ->get()
            ->keyBy('id_penyewaan');

        $pdf = Pdf::loadView('admin.laporan.laporan-pdf', compact(
            'totalPenyewaan',
            'totalSelesai',
            'totalMenunggu',
            'totalDitolak',
            'totalPendapatan',
            'totalDenda',
            'penyewaan',
            'pengembalian'
        ))->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-penyewaan-' . now()->format('Ymd') . '.pdf');
    }

    public function dashboard()
    {
        $hariIni = now()->toDateString();

        $penyewaanHariIni = Penyewaan::whereDate('tanggal_sewa', $hariIni);

        $totalPenyewaan = (clone $penyewaanHariIni)->count();

        $totalSelesai = (clone $penyewaanHariIni)
            ->where('status', 'dikembalikan')
            ->count();

        $totalMenunggu = (clone $penyewaanHariIni)
            ->where('status', 'menunggu')
            ->count();

        $totalPendapatan = (clone $penyewaanHariIni)
            ->whereIn('status', ['dibayar', 'dikembalikan'])
            ->sum('total_harga');

        $penyewaanTerbaru = Penyewaan::with([
            'user',
            'detailPenyewaan.barang',
        ])
            ->latest('id_penyewaan')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPenyewaan',
            'totalSelesai',
            'totalMenunggu',
            'totalPendapatan',
            'penyewaanTerbaru'
        ));
    }
}