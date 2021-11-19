<?php

namespace App\Http\Livewire\SuperAdmin\Buku;

use App\Models\Peminjaman;
use Livewire\Component;

class Riwayat extends Component
{
    public $buku_id;
    public $riwayat;

    public function mount()
    {
        $this->riwayat = Peminjaman::where('buku_id', $this->buku_id)->get();
    }

    public function render()
    {
        return view('livewire.super-admin.buku.riwayat');
    }
}
