<?php

namespace App\Http\Livewire\General\Buku;

use App\Models\Buku;
use Livewire\Component;

class View extends Component
{
    public $tab = [
        'peminjaman' => 'Dalam Peminjaman',
        'buku' => 'Buku Tersedia di Perpustakaan',
        'riwayat' => 'Riwayat Peminjaman'
    ];

    public $opt_order_by = [
        'latest' => 'terbaru',
        'older' => 'terlama'
    ];
    public $cari;
    public $order_by= 'latest';
    public $tabButton = 'peminjaman';

    public function mount()
    {
    }

    public function render()
    {
        $table = Buku::when($this->tabButton == 'peminjaman', function ($q) {
            $q->whereHas('riwayat', function ($q) {
                $q->where('users_id', auth()->user()->getAuthIdentifier());
            });
        })
            ->when($this->order_by == "latest", function ($q) {
                $q->latest();
            })
            ->when($this->order_by == "older", function ($q) {
                $q->oldest();
            })

            ->when($this->cari, function ($q) {
                $q->where('judul_buku', 'like', '%' . $this->cari . '%');
            })
            ->paginate(10);
        return view('livewire.general.buku.view')->with(compact('table'));
    }
}
