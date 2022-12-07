<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Info extends Component
{
    public $value, $type,$icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value, $type,$icon =true)
    {
        $this->value = $value;
        $this->type = $type;
        $this->icon = $icon;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.info');
    }
}
