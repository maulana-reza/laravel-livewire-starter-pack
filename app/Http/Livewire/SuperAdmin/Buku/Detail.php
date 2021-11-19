<?php

namespace App\Http\Livewire\SuperAdmin\Buku;

use App\Attribute\AttributePeminjaman;
use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Detail extends Component
{
    use AttributePeminjaman;

    public $pinjam = false;
    public $canRead = false;
    public $canPinjam = false;

    public function mount()
    {
        $this->buku = Buku::findOrFail($this->buku_id);
        //atur bisa pinjam
        if (auth()->user()->hasRole('general')) $this->canPinjam = true;

        //atur bisa baca
        if (Peminjaman::hasVerif($this->buku_id, auth()->user()->getAuthIdentifier())) $this->canRead = true;
    }

    public function render()
    {
        $view = view('livewire.super-admin.buku.detail');
        if (auth()->user()->hasRole('general')) {
            $view->layout('layouts.guest');
        } elseif (auth()->user()->hasRole('super-admin')) {

        }
        return $view;
    }

    public function pinjam()
    {
        $data = $this->validate();
        $start = Carbon::now();
        $end = Carbon::now()->addDay($this->lama);
        $prepare = [
            'buku_id' => $this->buku_id,
            'kode_peminjaman' => Peminjaman::kode(),
            'mulai_peminjaman' => $start->format('Y-m-d H:i:s'),
            'akhir_peminjaman' => $end->format('Y-m-d H:i:s'),
            'users_id' => auth()->user()->getAuthIdentifier(),
            'lama_peminjaman' => $this->lama,
        ];
        Peminjaman::create($prepare);
        return redirect()->route('buku.detail', ['buku_id' => $this->buku_id]);
    }
}
