<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KelolaUserController extends Controller
{
    // Menampilkan daftar seluruh akun admin dan pelanggan
    public function index(Request $request)
    {
        $cari = $request->input('cari');

        $users = User::query()
            ->when($cari, function ($query, $cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('nama', 'like', "%{$cari}%")
                        ->orWhere('email', 'like', "%{$cari}%")
                        ->orWhere('no_hp', 'like', "%{$cari}%")
                        ->orWhere('role', 'like', "%{$cari}%");
                });
            })
            ->latest('id_user')
            ->paginate(10)
            ->withQueryString();

        return view('admin.user.index', compact(
            'users',
            'cari'
        ));
    }

    // Menampilkan detail akun admin maupun pelanggan
    public function show($id)
    {
        $user = User::where('id_user', $id)
            ->firstOrFail();

        return view('admin.user.show', compact('user'));
    }

    // Mengubah status akun pelanggan saja
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Memastikan akun admin tidak bisa diubah statusnya
        $user = User::where('role', 'pelanggan')
            ->where('id_user', $id)
            ->firstOrFail();

        $user->status = $request->status;
        $user->save();

        return redirect()
            ->back()
            ->with(
                'success',
                'Status akun ' . $user->nama .
                ' berhasil diperbarui menjadi ' . $user->status . '.'
            );
    }
}