<?php

namespace App\Http\Livewire\SuperAdmin\Artikel;

use App\Attribute\AttributeBerita;
use App\Models\Berita;
use Livewire\Component;

class View extends Component
{
    use AttributeBerita;

    public function mount()
    {

    }

    public function render()
    {
        $article = Berita::when($this->judul,function ($q){
            $q->where('judul','like','%'.$this->judul.'%');
        })->paginate();
        return view('livewire.super-admin.artikel.view')
            ->with(compact('article'));
    }

    public function remove($id)
    {
        Berita::findOrFail($id)->delete();
        $this->emit("alert", ['body' => 'berhasil dihapus.', 'tipe' => 'success']);
    }
}
