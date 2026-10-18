<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(): View
    {
        return view('admin.master.index', [
            'title' => 'Data Pelanggan',
            'resource' => 'pelanggan',
            'columns' => [
                ['name' => 'nama', 'label' => 'Nama'],
                ['name' => 'email', 'label' => 'Email'],
                ['name' => 'no_hp', 'label' => 'No. HP'],
                ['name' => 'alamat', 'label' => 'Alamat'],
            ],
            'items' => Pelanggan::latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.master.form', [
            'title' => 'Pelanggan',
            'resource' => 'pelanggan',
            'item' => null,
            'fields' => [
                ['name' => 'nama', 'label' => 'Nama', 'type' => 'text', 'required' => true],
                ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
                ['name' => 'no_hp', 'label' => 'No. HP', 'type' => 'text'],
                ['name' => 'alamat', 'label' => 'Alamat', 'type' => 'textarea'],
            ],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Pelanggan::create($data);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('admin.master.form', [
            'title' => 'Pelanggan',
            'resource' => 'pelanggan',
            'item' => $pelanggan,
            'fields' => [
                ['name' => 'nama', 'label' => 'Nama', 'type' => 'text', 'required' => true],
                ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
                ['name' => 'no_hp', 'label' => 'No. HP', 'type' => 'text'],
                ['name' => 'alamat', 'label' => 'Alamat', 'type' => 'textarea'],
            ],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan->update($data);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus!');
    }
}
