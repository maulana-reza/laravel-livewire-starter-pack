<?php

namespace App\Http\Livewire\DefaultComponent\Home;

use Livewire\Component;

class View extends Component
{
    public function render()
    {
        return view('livewire.default-component.home.view')->layout('components.default-layout');
    }
}
