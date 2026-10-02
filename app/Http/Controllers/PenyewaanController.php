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
}
