<?php

namespace App\Http\Livewire\DefaultComponent\Buku;

use Livewire\Component;

class View extends Component
{
    public function render()
    {
        return view('livewire.default-component.buku.view')->layout('components.default-layout');
    }
}
