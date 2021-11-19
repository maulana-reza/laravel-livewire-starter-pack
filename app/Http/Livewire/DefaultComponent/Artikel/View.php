<?php

namespace App\Http\Livewire\DefaultComponent\Artikel;

use Livewire\Component;

class View extends Component
{
    public function render()
    {
        return view('livewire.default-component.artikel.view')->layout('components.default-layout');
    }
}
