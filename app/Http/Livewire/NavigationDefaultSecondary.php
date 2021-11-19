<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationDefaultSecondary extends Component
{
    public $menu = false;
    public $menuProfile = false;
    public function mount()
    {
    }
    public function render()
    {
        return view('livewire.navigation-default-secondary');
    }
    public function logout()
    {
        auth()->logout();
    }
}
