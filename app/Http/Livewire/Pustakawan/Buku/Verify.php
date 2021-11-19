<?php

namespace App\Http\Livewire\Pustakawan\Buku;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verify extends Component
{

    public $konfirmasi = false;
    public $tolak = false;
    public $opt_order_by = [
        'latest' => 'terbaru',
        'older' => 'terlama'
    ];
    public $cari;
    public $order_by = 'latest';

    public function render()
    {
        $table = Peminjaman::paginate(10);
        $view = view('livewire.pustakawan.buku.verify');
        if (!\auth()->user()->hasRole(['super-admin','pustakawan'])){
            $view->layout('component.guests');
        }
        $view->with(compact('table'));

        return $view;
    }

    public function konfirmasiBuku()
    {
        $peminjaman = Peminjaman::findOrFail($this->konfirmasi);
        $peminjaman->update([
            'status' => true,
            'access_id' => Auth::user()->getAuthIdentifier(),
        ]);
        $this->emit('alert', ['body' => 'Berhasil dikonfirmasi.', 'tipe' => 'success']);
    }

    public function konfirmasiTolak()
    {
        $peminjaman = Peminjaman::findOrFail($this->tolak);
        $peminjaman->update([
            'status' => false,
        ]);
        $this->emit('alert', ['body' => 'Berhasil dikonfirmasi.', 'tipe' => 'success']);

    }
}
