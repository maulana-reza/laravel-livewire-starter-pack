<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationDefault extends Component
{
    public $menu = false;

    public function render()
    {
        return view('livewire.navigation-default');
    }
}
