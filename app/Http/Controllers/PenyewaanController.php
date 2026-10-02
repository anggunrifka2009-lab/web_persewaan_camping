<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->cari;

        $penyewaan = Penyewaan::with('user')
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
        $penyewaan = Penyewaan::findOrFail($id);

        if ($penyewaan->status !== 'menunggu') {
            return back()->with('error', 'Penyewaan ini sudah diproses.');
        }

        $penyewaan->status = 'disetujui';
        $penyewaan->save();

        return back()->with('success', 'Penyewaan berhasil disetujui.');
    }

    public function tolak($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        if ($penyewaan->status !== 'menunggu') {
            return back()->with('error', 'Penyewaan ini sudah diproses.');
        }

        $penyewaan->status = 'ditolak';
        $penyewaan->save();

        return back()->with('success', 'Penyewaan berhasil ditolak.');
    }
}