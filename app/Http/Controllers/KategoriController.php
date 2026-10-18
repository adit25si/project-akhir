<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    private const FIELDS = [
        ['name' => 'nama_kategori', 'label' => 'Nama Kategori', 'type' => 'text', 'required' => true],
        ['name' => 'keterangan', 'label' => 'Keterangan', 'type' => 'textarea'],
    ];

    public function index(): View
    {
        return view('admin.master.index', [
            'title' => 'Data Kategori',
            'resource' => 'kategori',
            'columns' => [
                ['name' => 'nama_kategori', 'label' => 'Nama Kategori'],
                ['name' => 'keterangan', 'label' => 'Keterangan'],
            ],
            'items' => Kategori::latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.master.form', [
            'title' => 'Kategori',
            'resource' => 'kategori',
            'item' => null,
            'fields' => self::FIELDS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Kategori::create($data);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Data kategori berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        return view('admin.master.form', [
            'title' => 'Kategori',
            'resource' => 'kategori',
            'item' => Kategori::findOrFail($id),
            'fields' => self::FIELDS,
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $kategori = Kategori::findOrFail($id);
        $data = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $kategori->update($data);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Data kategori berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Kategori::findOrFail($id)->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Data kategori berhasil dihapus.');
    }
}
