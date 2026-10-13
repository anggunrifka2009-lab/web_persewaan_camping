<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class InformasiAkunController extends Controller
{
    public function index()
    {
        return view('akun.index', [
            'user' => auth()->user(),
        ]);
    }

    public function edit()
    {
        return view('akun.edit', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(
                    $user->id_user,
                    'id_user'
                ),
            ],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:1000'],
        ]);

        $user->update($validated);

        return redirect()
            ->route('akun.index')
            ->with('success', 'Informasi akun berhasil diperbarui.');
    }

    public function editPassword()
    {
        return view('akun.password');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'password_lama' => ['required', 'current_password'],
            'password_baru' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password_lama.current_password' => 'Password lama tidak sesuai.',
            'password_baru.min' => 'Password baru minimal 8 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        auth()->user()->update([
            'password' => Hash::make($validated['password_baru']),
        ]);

        return redirect()
            ->route('akun.index')
            ->with('success', 'Password berhasil diganti.');
    }
}