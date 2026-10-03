<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Barang;
use App\Models\DetailPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyewaanController extends Controller
{
    private $namaBank = 'NAMA BANK';
    private $nomorRekening = 'NOMOR REKENING';
    private $namaPemilikRekening = 'NAMA PEMILIK REKENING';

    public function index(Request $request)
    {
        $cari = $request->cari;

        $penyewaan = Penyewaan::with(['user', 'detailPenyewaan.barang'])
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

        return view('admin.penyewaan.index', compact('penyewaan', 'cari'));
    }

    public function setujui($id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $penyewaan = Penyewaan::with(['user', 'detailPenyewaan.barang'])
                ->lockForUpdate()
                ->findOrFail($id);

            if ($penyewaan->status !== 'menunggu') {
                return ['error' => 'Penyewaan ini sudah diproses.'];
            }

            $nomor = preg_replace('/\D/', '', $penyewaan->user->no_hp ?? '');

            if (str_starts_with($nomor, '0')) {
                $nomor = '62' . substr($nomor, 1);
            } elseif (str_starts_with($nomor, '8')) {
                $nomor = '62' . $nomor;
            }

            if (empty($nomor)) {
                return ['error' => 'Nomor WhatsApp pelanggan belum diisi.'];
            }

            $details = $penyewaan->detailPenyewaan;

            if ($details->isEmpty()) {
                return ['error' => 'Detail barang penyewaan tidak ditemukan.'];
            }

            foreach ($details as $detail) {
                $barang = Barang::where('id_barang', $detail->id_barang)
                    ->lockForUpdate()
                    ->first();

                if (!$barang) {
                    return ['error' => 'Barang yang disewa tidak ditemukan.'];
                }

                $terpakai = DetailPenyewaan::where('id_barang', $barang->id_barang)
                    ->whereHas('penyewaan', function ($query) use ($penyewaan) {
                        $query->whereIn('status', [
                            'disetujui',
                            'dibayar',
                            'berlangsung',
                        ])
                            ->where('id_penyewaan', '!=', $penyewaan->id_penyewaan)
                            ->whereDate(
                                'tanggal_sewa',
                                '<',
                                $penyewaan->tanggal_rencana_kembali
                            )
                            ->whereDate(
                                'tanggal_rencana_kembali',
                                '>',
                                $penyewaan->tanggal_sewa
                            );
                    })
                    ->sum('jumlah');

                if ($terpakai + $detail->jumlah > $barang->stok + $detail->jumlah) {
                    return [
                        'error' => "Stok {$barang->nama_barang} tidak mencukupi untuk tanggal penyewaan tersebut.",
                    ];
                }
            }

            $penyewaan->status = 'disetujui';
            $penyewaan->save();

            $daftarBarang = '';

            foreach ($details as $detail) {
                $namaBarang = $detail->barang->nama_barang ?? 'Barang';
                $daftarBarang .= "- {$namaBarang} ({$detail->jumlah} unit)\n";
            }

            $tanggalSewa = $penyewaan->tanggal_sewa->format('d-m-Y');
            $tanggalKembali = $penyewaan->tanggal_rencana_kembali->format('d-m-Y');

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

        $url = 'https://wa.me/' . $hasil['nomor']
            . '?text=' . urlencode($hasil['pesan']);

        return redirect()->away($url);
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

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function dikembalikan($id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $penyewaan = Penyewaan::where('id_penyewaan', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($penyewaan->status !== 'dibayar') {
                return false;
            }

            $details = DetailPenyewaan::where(
                'id_penyewaan',
                $penyewaan->id_penyewaan
            )->get();

            if ($details->isEmpty()) {
                return false;
            }

            foreach ($details as $detail) {
                $barang = Barang::where('id_barang', $detail->id_barang)
                    ->lockForUpdate()
                    ->first();

                if (!$barang) {
                    throw new \RuntimeException('Barang penyewaan tidak ditemukan.');
                }

                $barang->stok += $detail->jumlah;
                $barang->save();
            }

            $penyewaan->status = 'dikembalikan';
            $penyewaan->save();

            return true;
        });

        if (!$hasil) {
            return back()->with(
                'error',
                'Pengembalian sudah diproses atau detail barang tidak ditemukan.'
            );
        }

        return back()->with(
            'success',
            'Pengembalian barang berhasil dikonfirmasi dan stok telah dikembalikan.'
        );
    }

    public function tolak($id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $penyewaan = Penyewaan::where('id_penyewaan', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($penyewaan->status !== 'menunggu') {
                return false;
            }

            $details = DetailPenyewaan::where(
                'id_penyewaan',
                $penyewaan->id_penyewaan
            )->get();

            if ($details->isEmpty()) {
                return false;
            }

            foreach ($details as $detail) {
                $barang = Barang::where('id_barang', $detail->id_barang)
                    ->lockForUpdate()
                    ->first();

                if (!$barang) {
                    throw new \RuntimeException('Barang penyewaan tidak ditemukan.');
                }

                $barang->stok += $detail->jumlah;
                $barang->save();
            }

            $penyewaan->status = 'ditolak';
            $penyewaan->save();

            return true;
        });

        if (!$hasil) {
            return back()->with(
                'error',
                'Penyewaan sudah diproses atau detail barang tidak ditemukan.'
            );
        }

        return back()->with(
            'success',
            'Penyewaan berhasil ditolak dan stok telah dikembalikan.'
        );
    }
}