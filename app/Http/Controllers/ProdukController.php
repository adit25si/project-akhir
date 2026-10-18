<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    private const FIELDS = [
        ['name' => 'nama_produk', 'label' => 'Nama Produk', 'type' => 'text', 'required' => true],
        ['name' => 'harga', 'label' => 'Harga (Rp)', 'type' => 'number', 'required' => true, 'step' => '0.01', 'min' => '0'],
        ['name' => 'stok', 'label' => 'Stok', 'type' => 'number', 'required' => true, 'step' => '1', 'min' => '0'],
        ['name' => 'deskripsi', 'label' => 'Deskripsi', 'type' => 'textarea'],
    ];

    public function index(): View
    {
        return view('admin.master.index', [
            'title' => 'Data Produk',
            'resource' => 'produk',
            'columns' => [
                ['name' => 'nama_produk', 'label' => 'Nama Produk'],
                ['name' => 'harga', 'label' => 'Harga', 'type' => 'currency'],
                ['name' => 'stok', 'label' => 'Stok'],
                ['name' => 'deskripsi', 'label' => 'Deskripsi'],
            ],
            'items' => Produk::latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.master.form', [
            'title' => 'Produk',
            'resource' => 'produk',
            'item' => null,
            'fields' => self::FIELDS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'stok' => ['required', 'integer', 'min:0', 'max:4294967295'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        Produk::create($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Data produk berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        return view('admin.master.form', [
            'title' => 'Produk',
            'resource' => 'produk',
            'item' => Produk::findOrFail($id),
            'fields' => self::FIELDS,
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $produk = Produk::findOrFail($id);
        $data = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'stok' => ['required', 'integer', 'min:0', 'max:4294967295'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $produk->update($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Produk::findOrFail($id)->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Data produk berhasil dihapus.');
    }
}
