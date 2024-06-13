<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        return view('barangs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('gambar')->store('public/images');

        Barang::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'gambar' => $path,
        ]);

        return redirect()->route('barangs.index')
            ->with('success', 'Barang created successfully.');
    }

    public function show(Barang $barang)
    {
        return view('barangs.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barangs.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'name' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('images', 'public');
            // $path = $request->file('gambar')->store('public/images');
            if (Storage::exists($barang->gambar)) {
                Storage::delete($barang->gambar);
            }
            $barang->gambar = $path;
        }

        $barang->update($request->all());

        return redirect()->route('barangs.index')
            ->with('success', 'Barang updated successfully.');
    }

    public function destroy(Barang $barang)
    {
        if (Storage::exists($barang->gambar)) {
            Storage::delete($barang->gambar);
        }
        $barang->delete();

        return redirect()->route('barangs.index')
            ->with('success', 'Barang deleted successfully.');
    }
}
