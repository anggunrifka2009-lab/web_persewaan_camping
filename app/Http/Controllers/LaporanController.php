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
        $request->validate([
            'dari'   => 'nullable|date',
            'sampai' => 'nullable|date|after_or_equal:dari',
        ]);

        $penyewaan = $this->queryPenyewaan($request)
            ->with([
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

        return view('admin.laporan.index', array_merge(
            $this->ringkasan($request),
            compact('penyewaan', 'pengembalian')
        ));
    }

    public function cetakPdf(Request $request)
    {
        $request->validate([
            'dari'   => 'nullable|date',
            'sampai' => 'nullable|date|after_or_equal:dari',
        ]);

        // Semua data dalam rentang tanggal, bukan paginate
        $penyewaan = $this->queryPenyewaan($request)
            ->with([
                'user',
                'detailPenyewaan.barang',
            ])
            ->latest('id_penyewaan')
            ->get();

        $pengembalian = DB::table('pengembalian')
            ->whereIn('id_penyewaan', $penyewaan->pluck('id_penyewaan'))
            ->get()
            ->keyBy('id_penyewaan');

        $dari   = $request->input('dari');
        $sampai = $request->input('sampai');

        $pdf = Pdf::loadView('admin.laporan.laporan-pdf', array_merge(
            $this->ringkasan($request),
            compact('penyewaan', 'pengembalian', 'dari', 'sampai')
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

    /**
     * Query dasar penyewaan dengan filter rentang tanggal sewa.
     */
    private function queryPenyewaan(Request $request)
    {
        return Penyewaan::query()
            ->when($request->filled('dari'), fn ($q) =>
                $q->whereDate('tanggal_sewa', '>=', $request->input('dari')))
            ->when($request->filled('sampai'), fn ($q) =>
                $q->whereDate('tanggal_sewa', '<=', $request->input('sampai')));
    }

    /**
     * Angka ringkasan, mengikuti filter tanggal yang sama dengan tabel.
     */
    private function ringkasan(Request $request): array
    {
        $base = $this->queryPenyewaan($request);

        return [
            'totalPenyewaan' => (clone $base)->count(),

            'totalSelesai' => (clone $base)
                ->where('status', 'dikembalikan')
                ->count(),

            'totalMenunggu' => (clone $base)
                ->where('status', 'menunggu')
                ->count(),

            'totalDitolak' => (clone $base)
                ->where('status', 'ditolak')
                ->count(),

            'totalPendapatan' => (clone $base)
                ->whereIn('status', ['dibayar', 'dikembalikan'])
                ->sum('total_harga'),

            'totalDenda' => DB::table('pengembalian')
                ->whereIn('id_penyewaan', (clone $base)->select('id_penyewaan'))
                ->sum('denda'),
        ];
    }
}