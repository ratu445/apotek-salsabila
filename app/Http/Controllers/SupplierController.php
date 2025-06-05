<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|max:125',
            'alamat' => 'required',
            'no_telp' => 'required|max:15',
            'email' => 'nullable|email|max:125',
            'npwp' => 'nullable|max:25'
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier' => 'required|max:125',
            'alamat' => 'required',
            'no_telp' => 'required|max:15',
            'email' => 'nullable|email|max:125',
            'npwp' => 'nullable|max:25'
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->barangs()->count() > 0) {
            return redirect()->route('supplier.index')
                ->with('error', 'Tidak dapat menghapus supplier karena masih menyuplai barang');
        }

        $supplier->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil dihapus');
    }
}