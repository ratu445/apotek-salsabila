<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $penggunas = Pengguna::all();
        return view('pengguna.index', compact('penggunas'));
    }

    public function create()
    {
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|max:125',
            'alamat' => 'required',
            'no_hp' => 'required|max:15',
            'username' => 'required|max:125|unique:pengguna,username',
            'password' => 'required|min:6',
            'level_user' => 'required|in:1,2,3,4'
        ]);

        Pengguna::create([
            'nama_pengguna' => $request->nama_pengguna,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level_user' => $request->level_user
        ]);

        return redirect()->route('pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit(Pengguna $pengguna)
    {
        return view('pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $request->validate([
            'nama_pengguna' => 'required|max:125',
            'alamat' => 'required',
            'no_hp' => 'required|max:15',
            'username' => 'required|max:125|unique:pengguna,username,'.$pengguna->id_pengguna.',id_pengguna',
            'password' => 'nullable|min:6',
            'level_user' => 'required|in:1,2,3,4'
        ]);

        $data = [
            'nama_pengguna' => $request->nama_pengguna,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'username' => $request->username,
            'level_user' => $request->level_user
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        return redirect()->route('pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(Pengguna $pengguna)
    {
        if ($pengguna->reseps()->count() > 0) {
            return redirect()->route('pengguna.index')
                ->with('error', 'Tidak dapat menghapus pengguna karena masih memiliki resep');
        }

        $pengguna->delete();

        return redirect()->route('pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}