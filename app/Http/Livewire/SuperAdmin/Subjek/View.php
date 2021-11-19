<?php

namespace App\Http\Livewire\SuperAdmin\Subjek;

use App\Attribute\AttributeSubjek;
use App\Models\Subjek;
use App\Repository\SuperAdmin\DataMaster\DataMasterInterface;
use Livewire\Component;
use Livewire\WithPagination;

class View extends Component implements DataMasterInterface
{

    use WithPagination, AttributeSubjek;

    public $idSubjek;
    public $rules = [
        'nama' => 'required'
    ];

    public function render()
    {
        $table = Subjek::paginate(10);
        return view('livewire.super-admin.subjek.view')
            ->with(compact('table'));
    }

    public function save()
    {
        $data = $this->validate();
        Subjek::updateOrCreate(['id' => $this->idSubjek], $data);

    }

    public function edit(int $id)
    {
        $subjek = Subjek::findOrFail($id);
        $this->nama = $subjek->nama;
    }

    public function remove(int $id)
    {
        $subjek = Subjek::findOrFail($id);
        $subjek->delete();
    }
}
