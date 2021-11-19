<?php

namespace App\Http\Livewire\SuperAdmin\Kategori;

use App\Attribute\AttributeKategori;
use App\Models\Kategori;
use App\Repository\SuperAdmin\DataMaster\DataMasterInterface;
use Livewire\Component;
use Livewire\WithPagination;

class View extends Component implements DataMasterInterface
{
    use WithPagination, AttributeKategori;

    public $modal = false;
    public $idKategori = false;
    protected $rules = [
        'nama' => 'required|unique:kategori,nama'
    ];

    public function mount()
    {

    }

    public function render()
    {
        $table = Kategori::latest()->paginate(10);
        return view('livewire.super-admin.kategori.view')
            ->with(compact('table'));
    }

    public function save()
    {
        $data = $this->validate();
        Kategori::updateOrCreate(['id' => $this->idKategori], $data);
        $this->idKategori = false;
    }

    public function edit(int $id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->nama = $kategori->nama;
        $this->idKategori = $id;
    }

    public function remove(int $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
    }
}
