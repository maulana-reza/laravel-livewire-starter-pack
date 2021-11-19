<?php

namespace App\Http\Livewire\SuperAdmin\Artikel;

use App\Attribute\AttributeArtikel;
use App\Models\Berita;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    public $artikel_id = false;
    use AttributeArtikel, WithFileUploads;

    public $rules = [
        'cover' => 'required|mimes:jpg,jpeg,png',
        'content' => 'required',
        'judul' => 'required',
    ];

    public function mount()
    {
        if ($this->artikel_id) {
            $berita = Berita::findOrFail($this->artikel_id);
            $this->mountArtikel($berita);
        }

    }

    public function save()
    {
        if (is_string($this->cover)) {
            unset($this->rules['cover']);
        }
        $data = $this->validate();
        if (!is_string($this->cover) && $this->cover) {
            $data['cover'] = $this->cover->store('cover');
        }
        $data['creator_id'] = auth()->user()->getAuthIdentifier();
        Berita::updateOrCreate([
            'id' => $this->artikel_id,
        ], $data);
        if ($this->artikel_id){
            session()->flash('success', 'Berita berhasil diubah.');

        }else{
            session()->flash('success', 'Berita berhasil dibuat.');

        }
        return Redirect::signedRoute('artikel.list');
    }

    public function render()
    {
        return view('livewire.super-admin.artikel.add');
    }
}
