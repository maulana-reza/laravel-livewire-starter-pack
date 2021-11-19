<?php

namespace App\Http\Livewire\SuperAdmin\DataMaster;

use Livewire\Component;

class View extends Component
{
    public $tab = [
        'kategori' => 'Kategori',
        'subjek' => 'Subjek'
    ];
    public $tabButton = 'kategori';

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.super-admin.data-master.view');
    }
}
