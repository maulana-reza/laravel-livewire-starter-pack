<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DefaultSelect extends Component
{
    public $name;
    public $option;
    public $value;
    public $multiple;
    public $title;
    public $readonly;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $option, $value = "",$title,$multiple=false,$readonly = false)
    {
        //
        $this->title = $title;
        $this->name = $name;
        $this->option = $option;
        $this->value = $value;
        $this->multiple = $multiple;
        $this->readonly = $readonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.default-select');
    }
}
