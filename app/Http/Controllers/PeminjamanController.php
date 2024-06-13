<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('user', 'barang')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('peminjaman.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);

        return redirect()->route('peminjaman.create')
            ->with('success', 'Peminjaman created successfully.');
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $peminjaman->update([
            'status' => $request->status,
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman updated successfully.');
    }

    public function myPeminjaman()
    {
        $peminjaman = Peminjaman::where('user_id', Auth::id())->with('barang')->get();
        return view('peminjaman.my', compact('peminjaman'));
    }
}
