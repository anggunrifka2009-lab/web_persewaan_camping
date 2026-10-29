<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Barang;
use App\Models\DetailPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenyewaanController extends Controller
{
    private $namaBank = 'NAMA BANK';
    private $nomorRekening = 'NOMOR REKENING';
    private $namaPemilikRekening = 'NAMA PEMILIK REKENING';
    private $tarifDendaPerHari = 5000;

    public function index(Request $request)
    {
        $cari = $request->cari;

        $penyewaan = Penyewaan::with([
            'user',
            'detailPenyewaan.barang',
        ])
            ->when($cari, function ($query, $cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('kode_penyewaan', 'like', "%{$cari}%")
                        ->orWhereHas('user', function ($user) use ($cari) {
                            $user->where('nama', 'like', "%{$cari}%");
                        });
                });
            })
            ->latest('id_penyewaan')
            ->paginate(5)
            ->withQueryString();

        $pengembalian = DB::table('pengembalian')
            ->whereIn(
                'id_penyewaan',
                $penyewaan->getCollection()->pluck('id_penyewaan')
            )
            ->get()
            ->keyBy('id_penyewaan');

        return view(
            'admin.penyewaan.index',
            compact('penyewaan', 'cari', 'pengembalian')
        );
    }

    private function normalisasiNomorWhatsApp($nomor)
    {
        $nomor = preg_replace('/\D/', '', $nomor ?? '');

        if (str_starts_with($nomor, '0')) {
            $nomor = '62' . substr($nomor, 1);
        } elseif (str_starts_with($nomor, '8')) {
            $nomor = '62' . $nomor;
        }

        if (strlen($nomor) < 10 || strlen($nomor) > 15) {
            return null;
        }

        return $nomor;
    }

    private function bukaWhatsApp($nomor, $pesan)
    {
        $url = 'https://wa.me/' . $nomor
            . '?text=' . urlencode($pesan);

        return redirect()->away($url);
    }

    public function setujui($id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $penyewaan = Penyewaan::with([
                'user',
                'detailPenyewaan.barang',
            ])
                ->where('id_penyewaan', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($penyewaan->status !== 'menunggu') {
                return ['error' => 'Penyewaan ini sudah diproses.'];
            }

            $details = $penyewaan->detailPenyewaan;

            if ($details->isEmpty()) {
                return ['error' => 'Detail barang penyewaan tidak ditemukan.'];
            }

            $nomor = $this->normalisasiNomorWhatsApp(
                $penyewaan->user->no_hp ?? ''
            );

            if (!$nomor) {
                return ['error' => 'Nomor WhatsApp pelanggan belum valid. Status penyewaan tidak diubah.'];
            }

            $penyewaan->status = 'disetujui';
            $penyewaan->save();

            $daftarBarang = '';

            foreach ($details as $detail) {
                $namaBarang = $detail->barang->nama_barang ?? 'Barang';
                $daftarBarang .= "- {$namaBarang} ({$detail->jumlah} unit)\n";
            }

            $tanggalSewa = Carbon::parse(
                $penyewaan->tanggal_sewa
            )->format('d-m-Y');

            $tanggalKembali = Carbon::parse(
                $penyewaan->tanggal_rencana_kembali
            )->format('d-m-Y');

            $totalHarga = 'Rp ' . number_format(
                $penyewaan->total_harga,
                0,
                ',',
                '.'
            );

            $pesan = "Halo {$penyewaan->user->nama}, penyewaan alat camping kamu telah disetujui.\n\n"
                . "RINCIAN PENYEWAAN\n"
                . "Kode: {$penyewaan->kode_penyewaan}\n"
                . "Barang:\n{$daftarBarang}"
                . "Tanggal sewa: {$tanggalSewa}\n"
                . "Tanggal kembali: {$tanggalKembali}\n"
                . "Total pembayaran: {$totalHarga}\n\n"
                . "INFORMASI PEMBAYARAN\n"
                . "Bank: {$this->namaBank}\n"
                . "Nomor rekening: {$this->nomorRekening}\n"
                . "Atas nama: {$this->namaPemilikRekening}\n\n"
                . "Silakan lakukan pembayaran dan kirim bukti pembayaran melalui WhatsApp ini. Pembayaran akan dikonfirmasi oleh admin. Terima kasih.";

            return [
                'nomor' => $nomor,
                'pesan' => $pesan,
            ];
        });

        if (isset($hasil['error'])) {
            return back()->with('error', $hasil['error']);
        }

        return $this->bukaWhatsApp(
            $hasil['nomor'],
            $hasil['pesan']
        );
    }

    public function konfirmasiPembayaran($id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $penyewaan = Penyewaan::where('id_penyewaan', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($penyewaan->status !== 'disetujui') {
                return false;
            }

            $penyewaan->status = 'dibayar';
            $penyewaan->save();

            return true;
        });

        if (!$hasil) {
            return back()->with(
                'error',
                'Pembayaran hanya bisa dikonfirmasi untuk penyewaan yang sudah disetujui.'
            );
        }

        return back()->with(
            'success',
            'Pembayaran berhasil dikonfirmasi.'
        );
    }

    public function batalkan($id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $penyewaan = Penyewaan::with('user')
                ->where('id_penyewaan', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($penyewaan->status !== 'dibayar') {
                return [
                    'error' => 'Hanya penyewaan berstatus dibayar yang bisa dibatalkan.',
                ];
            }

            $tanggalSewa = Carbon::parse(
                $penyewaan->tanggal_sewa
            )->startOfDay();

            if (Carbon::today()->greaterThanOrEqualTo($tanggalSewa)) {
                return [
                    'error' => 'Penyewaan tidak bisa dibatalkan karena tanggal sewa sudah tiba.',
                ];
            }

            $nomor = $this->normalisasiNomorWhatsApp(
                $penyewaan->user->no_hp ?? ''
            );

            if (!$nomor) {
                return [
                    'error' => 'Nomor WhatsApp pelanggan belum valid. Pembatalan tidak dilakukan.',
                ];
            }

            $details = DetailPenyewaan::where(
                'id_penyewaan',
                $penyewaan->id_penyewaan
            )->get();

            if ($details->isEmpty()) {
                return [
                    'error' => 'Detail barang penyewaan tidak ditemukan.',
                ];
            }

            foreach ($details as $detail) {
                $barang = Barang::where('id_barang', $detail->id_barang)
                    ->lockForUpdate()
                    ->first();

                if (!$barang) {
                    throw new \RuntimeException(
                        'Barang penyewaan tidak ditemukan.'
                    );
                }

                $barang->stok += (int) $detail->jumlah;
                $barang->save();
            }

            $penyewaan->status = 'dibatalkan';
            $penyewaan->save();

            $tanggalSewaFormat = Carbon::parse(
                $penyewaan->tanggal_sewa
            )->format('d-m-Y');

            $pesan = "Halo {$penyewaan->user->nama},\n\n"
                . "Kami informasikan bahwa penyewaan alat camping kamu telah dibatalkan oleh admin CampRent.\n\n"
                . "Kode penyewaan: {$penyewaan->kode_penyewaan}\n"
                . "Tanggal sewa: {$tanggalSewaFormat}\n"
                . "Total pembayaran: Rp "
                . number_format($penyewaan->total_harga, 0, ',', '.')
                . "\n\n"
                . "Jika kamu sudah melakukan pembayaran, silakan hubungi admin untuk informasi pengembalian dana.\n\n"
                . "Mohon maaf atas ketidaknyamanannya. Terima kasih.";

            return [
                'nomor' => $nomor,
                'pesan' => $pesan,
            ];
        });

        if (isset($hasil['error'])) {
            return back()->with('error', $hasil['error']);
        }

        return $this->bukaWhatsApp(
            $hasil['nomor'],
            $hasil['pesan']
        );
    }

    public function dikembalikan($id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $penyewaan = Penyewaan::where('id_penyewaan', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($penyewaan->status !== 'dibayar') {
                return [
                    'error' => 'Penyewaan ini belum dibayar atau sudah diproses.',
                ];
            }

            $tanggalSewa = Carbon::parse(
                $penyewaan->tanggal_sewa
            )->startOfDay();

            if (Carbon::today()->lt($tanggalSewa)) {
                return [
                    'error' => 'Pengembalian baru bisa dikonfirmasi saat tanggal sewa tiba.',
                ];
            }

            $details = DetailPenyewaan::where(
                'id_penyewaan',
                $penyewaan->id_penyewaan
            )->get();

            if ($details->isEmpty()) {
                return [
                    'error' => 'Detail barang penyewaan tidak ditemukan.',
                ];
            }

            $sudahAda = DB::table('pengembalian')
                ->where('id_penyewaan', $id)
                ->exists();

            if ($sudahAda) {
                return [
                    'error' => 'Pengembalian penyewaan ini sudah diproses.',
                ];
            }

            $tanggalRencana = Carbon::parse(
                $penyewaan->tanggal_rencana_kembali
            )->startOfDay();

            $tanggalKembali = Carbon::today();

            $hariTerlambat = $tanggalKembali->greaterThan($tanggalRencana)
                ? (int) $tanggalRencana->diffInDays($tanggalKembali)
                : 0;

            $denda = $hariTerlambat * $this->tarifDendaPerHari;

            foreach ($details as $detail) {
                $barang = Barang::where('id_barang', $detail->id_barang)
                    ->lockForUpdate()
                    ->first();

                if (!$barang) {
                    throw new \RuntimeException(
                        'Barang penyewaan tidak ditemukan.'
                    );
                }

                $barang->stok += (int) $detail->jumlah;
                $barang->save();
            }

            DB::table('pengembalian')->insert([
                'id_penyewaan' => $id,
                'tanggal_pengembalian' => $tanggalKembali->toDateString(),
                'denda' => $denda,
                'keterangan' => $hariTerlambat > 0
                    ? "Terlambat {$hariTerlambat} hari"
                    : 'Dikembalikan tepat waktu',
            ]);

            $penyewaan->status = 'dikembalikan';
            $penyewaan->save();

            return [
                'hari_terlambat' => $hariTerlambat,
                'denda' => $denda,
            ];
        });

        if (isset($hasil['error'])) {
            return back()->with('error', $hasil['error']);
        }

        $pesan = $hasil['hari_terlambat'] > 0
            ? 'Pengembalian dikonfirmasi. Denda keterlambatan: Rp '
                . number_format($hasil['denda'], 0, ',', '.')
            : 'Pengembalian berhasil dikonfirmasi tanpa denda keterlambatan.';

        return back()->with('success', $pesan);
    }

    public function tolak($id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $penyewaan = Penyewaan::where('id_penyewaan', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($penyewaan->status !== 'menunggu') {
                return [
                    'error' => 'Penyewaan sudah diproses.',
                ];
            }

            $details = DetailPenyewaan::where(
                'id_penyewaan',
                $penyewaan->id_penyewaan
            )->get();

            if ($details->isEmpty()) {
                return [
                    'error' => 'Detail barang penyewaan tidak ditemukan.',
                ];
            }

            foreach ($details as $detail) {
                $barang = Barang::where('id_barang', $detail->id_barang)
                    ->lockForUpdate()
                    ->first();

                if (!$barang) {
                    throw new \RuntimeException(
                        'Barang penyewaan tidak ditemukan.'
                    );
                }

                $barang->stok += (int) $detail->jumlah;
                $barang->save();
            }

            $penyewaan->status = 'ditolak';
            $penyewaan->save();

            return ['success' => true];
        });

        if (isset($hasil['error'])) {
            return back()->with('error', $hasil['error']);
        }

        return back()->with(
            'success',
            'Penyewaan berhasil ditolak dan stok telah dikembalikan.'
        );
    }
}