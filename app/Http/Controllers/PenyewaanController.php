<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Barang;
use App\Models\DetailPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyewaanController extends Controller
{
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

        return view(
            'admin.penyewaan.index',
            compact('penyewaan', 'cari')
        );
    }

    public function setujui($id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $penyewaan = Penyewaan::with('user')
                ->lockForUpdate()
                ->findOrFail($id);

            if ($penyewaan->status !== 'menunggu') {
                return [
                    'error' => 'Penyewaan ini sudah diproses.'
                ];
            }

            $nomor = preg_replace(
                '/\D/',
                '',
                $penyewaan->user->no_hp ?? ''
            );

            if (str_starts_with($nomor, '0')) {
                $nomor = '62' . substr($nomor, 1);
            } elseif (str_starts_with($nomor, '8')) {
                $nomor = '62' . $nomor;
            }

            if (empty($nomor)) {
                return [
                    'error' => 'Nomor WhatsApp pelanggan belum diisi.'
                ];
            }

            $detail = DetailPenyewaan::where(
                'id_penyewaan',
                $penyewaan->id_penyewaan
            )->first();

            if (!$detail) {
                return [
                    'error' => 'Detail barang penyewaan tidak ditemukan.'
                ];
            }

            $barang = Barang::where(
                'id_barang',
                $detail->id_barang
            )->lockForUpdate()->first();

            if (!$barang) {
                return [
                    'error' => 'Barang yang disewa tidak ditemukan.'
                ];
            }

            $terpakai = DetailPenyewaan::where(
                'id_barang',
                $barang->id_barang
            )
                ->whereHas('penyewaan', function ($query) use ($penyewaan) {
                    $query->where('status', 'disetujui')
                        ->where(
                            'id_penyewaan',
                            '!=',
                            $penyewaan->id_penyewaan
                        )
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

            if ($terpakai + $detail->jumlah > $barang->stok) {
                return [
                    'error' => 'Stok barang tidak mencukupi untuk tanggal penyewaan tersebut.'
                ];
            }

            $penyewaan->status = 'disetujui';
            $penyewaan->save();

            $pesan = "Halo {$penyewaan->user->nama}, penyewaan kamu dengan kode {$penyewaan->kode_penyewaan} telah disetujui. Silakan lanjutkan proses pembayaran. Terima kasih.";

            return [
                'nomor' => $nomor,
                'pesan' => $pesan
            ];
        });

        if (isset($hasil['error'])) {
            return back()->with('error', $hasil['error']);
        }

        $url = 'https://wa.me/' . $hasil['nomor']
            . '?text=' . urlencode($hasil['pesan']);

        return redirect()->away($url);
    }

    public function tolak($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        if ($penyewaan->status !== 'menunggu') {
            return back()->with(
                'error',
                'Penyewaan ini sudah diproses.'
            );
        }

        $penyewaan->status = 'ditolak';
        $penyewaan->save();

        return back()->with(
            'success',
            'Penyewaan berhasil ditolak.'
        );
    }
}