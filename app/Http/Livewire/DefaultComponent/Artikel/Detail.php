<?php

namespace App\Http\Livewire\DefaultComponent\Artikel;

use App\Models\Berita;
use Livewire\Component;

class Detail extends Component
{

    public $artikel_id = false;
    public $artikel;
    public function mount()
    {
        $this->artikel = Berita::findOrFail($this->artikel_id);
    }
    public function render()
    {
        return view('livewire.default-component.artikel.detail')->layout('components.default-layout');
    }
}
