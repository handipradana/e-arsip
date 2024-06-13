<?php

// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\BarangController;

// Route::get('/', function () {
//     if (Auth::check()) {
//         $role = Auth::user()->role;
//         if ($role === 'admin') {
//             return redirect()->route('admin.dashboard');
//         } elseif ($role === 'staff') {
//             return redirect()->route('staff.dashboard');
//         } elseif ($role === 'operator') {
//             return redirect()->route('operator.dashboard');
//         }
//     }
//     return redirect('/login');
// });

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware('auth')->group(function () {
//     Route::middleware('role:admin')->group(function () {
//         Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
//     });

//     Route::middleware('role:staff')->group(function () {
//         Route::get('/staff', [DashboardController::class, 'staff'])->name('staff.dashboard');
//     });

//     Route::middleware('role:operator')->group(function () {
//         Route::get('/operator', [DashboardController::class, 'operator'])->name('operator.dashboard');
//     });

//     Route::middleware('role:admin,operator')->group(function () {
//         Route::resource('barangs', BarangController::class);
//     });
// });

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route dashboard dinamis
Route::get('/home', [DashboardController::class, 'redirectToDashboard'])->name('home');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::resource('users', UserController::class);
        Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'show']);
    });

    Route::middleware('role:staff')->group(function () {
        Route::get('/staff', [DashboardController::class, 'staff'])->name('staff.dashboard');
        Route::resource('peminjaman', PeminjamanController::class)->only(['create', 'store', 'show']);
        Route::get('/my-peminjaman', [PeminjamanController::class, 'myPeminjaman'])->name('peminjaman.my');
    });

    Route::middleware('role:operator')->group(function () {
        Route::get('/operator', [DashboardController::class, 'operator'])->name('operator.dashboard');
        Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'update', 'show']);
    });

    Route::middleware('role:admin,operator')->group(function () {
        Route::resource('barangs', BarangController::class);
        Route::resource('peminjaman', PeminjamanController::class);
    });
});



// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\BarangController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\PeminjamanController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect('/login');
// });

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Route dashboard dinamis
// Route::get('/home', [DashboardController::class, 'redirectToDashboard'])->name('home');

// Route::middleware('auth')->group(function () {
//     Route::middleware('role:admin')->group(function () {
//         Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
//         Route::resource('users', UserController::class);
//         Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
//     });

//     Route::middleware('role:staff')->group(function () {
//         Route::get('/staff', [DashboardController::class, 'staff'])->name('staff.dashboard');
//         Route::get('peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
//         Route::post('peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
//         Route::get('peminjaman/{peminjaman}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
//         Route::get('/my-peminjaman', [PeminjamanController::class, 'myPeminjaman'])->name('peminjaman.my');
//     });

//     Route::middleware('role:operator')->group(function () {
//         Route::get('/operator', [DashboardController::class, 'operator'])->name('operator.dashboard');
//         Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
//         Route::put('peminjaman/{peminjaman}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
//         Route::get('peminjaman/{peminjaman}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
//     });

//     Route::middleware('role:admin,operator')->group(function () {
//         Route::resource('barangs', BarangController::class);
//     });
// });




// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\BarangController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\PeminjamanController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect('/login');
// });

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Route dashboard dinamis
// Route::get('/home', [DashboardController::class, 'redirectToDashboard'])->name('home');

// Route::middleware('auth')->group(function () {
//     Route::middleware('role:admin')->group(function () {
//         Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
//         Route::resource('users', UserController::class);
//         Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'show']);
//         // Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
//     });

//     Route::middleware('role:staff')->group(function () {
//         Route::get('/staff', [DashboardController::class, 'staff'])->name('staff.dashboard');
//         Route::resource('peminjaman', PeminjamanController::class)->only(['create', 'store', 'show']);
//     });

//     Route::middleware('role:operator')->group(function () {
//         Route::get('/operator', [DashboardController::class, 'operator'])->name('operator.dashboard');
//         Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'update', 'show']);
//     });

//     Route::middleware('role:admin,operator')->group(function () {
//         Route::resource('barangs', BarangController::class);
//     });
// });










// Route::get('/', function () {
//     return view('welcome');
// });
