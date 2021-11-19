<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//pustakawan
Route::prefix('pustakawan')->middleware(['role:pustakawan','auth:sanctum'])->group(function () {
    Route::get('buku/verifi',\App\Http\Livewire\Pustakawan\Buku\Verify::class)->name('pustakawan.buku.verify');
});
//general
Route::prefix('general')->middleware(['role:general','auth:sanctum'])->group(function () {
    Route::prefix('buku')->group(function () {
        Route::get('', \App\Http\Livewire\General\Buku\View::class)->name('general.buku.list');
        Route::get('detail/{buku_id}', \App\Http\Livewire\General\Buku\Detail::class)->name('general.buku.detail');
        Route::get('riwayat', \App\Http\Livewire\General\Buku\Riwayat::class)->name('general.buku.riwayat');
    });
});

// super-admin
Route::prefix('super-admin')->middleware(['auth:sanctum', 'verified', 'role:super-admin'])->group(function () {
    Route::get('users', \App\Http\Livewire\SuperAdmin\Users::class)->name('user.list');
    Route::get('setting', \App\Http\Livewire\SuperAdmin\Setting\View::class)->name('setting.list');
    Route::get('data-master', \App\Http\Livewire\SuperAdmin\DataMaster\View::class)->name("datamaster.list");
    Route::get('buku', \App\Http\Livewire\SuperAdmin\Buku\View::class)->name('buku.list');
    Route::get('artikel', \App\Http\Livewire\SuperAdmin\Artikel\View::class)->name('artikel.list');
    Route::get('artikel/add', \App\Http\Livewire\SuperAdmin\Artikel\Add::class)->name('artikel.add');
    Route::get('artikel/edit/{artikel_id}', \App\Http\Livewire\SuperAdmin\Artikel\Add::class)->name('artikel.edit');
});

//    Route::get('buku/detail/{buku_id}', \App\Http\Livewire\SuperAdmin\Buku\Detail::class)->name("buku.detail");
//});

// front start
Route::get('/', App\Http\Livewire\DefaultComponent\Home\View::class)->name('home');

Route::get('artikel', \App\Http\Livewire\DefaultComponent\Artikel\View::class)->name('default.artikel.list');
Route::get('artikel/detail/{artikel_id}', \App\Http\Livewire\DefaultComponent\Artikel\Detail::class)->name('default.artikel.detail');

Route::get('buku', \App\Http\Livewire\DefaultComponent\Buku\View::class)->name('default.buku.list');
Route::prefix('')->middleware(['auth:sanctum','role:super-admin|general|pustakawan','has_pinjam'])->group(function () {
    Route::get('buku/detail/{buku_id}', \App\Http\Livewire\SuperAdmin\Buku\Detail::class)->name('buku.detail');
});
//front end

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (auth()->user()->hasRole('general')){
        return redirect()->route('general.buku.list');
    }elseif (auth()->user()->hasRole('pustakawan')){
        return redirect()->route('pustakawan.buku.verify');
    }
    return view('dashboard');
})->name('dashboard');
