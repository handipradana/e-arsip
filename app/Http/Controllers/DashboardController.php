<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function redirectToDashboard()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'staff') {
            return redirect()->route('staff.dashboard');
        } elseif (Auth::user()->role === 'operator') {
            return redirect()->route('operator.dashboard');
        }
    }

    public function admin()
    {
        $userCount = User::count();
        $peminjamanCount = Peminjaman::count();
        $barangCount = Barang::count();

        return view('dashboard.admin', compact('userCount', 'peminjamanCount', 'barangCount'));
    }

    public function staff()
    {
        $myPeminjamanCount = Peminjaman::where('user_id', Auth::id())->count();

        return view('dashboard.staff', compact('myPeminjamanCount'));
    }

    public function operator()
    {
        $peminjamanCount = Peminjaman::count();
        $barangCount = Barang::count();

        return view('dashboard.operator', compact('peminjamanCount', 'barangCount'));
    }
}
