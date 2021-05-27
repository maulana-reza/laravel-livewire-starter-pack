<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DefaultDataMaster extends Component
{
    public $idName;
    public $table;
    public $title;
    public $nama;
    public $show;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nama,$title,$table,$idName)
    {
        $this->nama = $nama;
        $this->title = $title;
        $this->table = $table;
        $this->idName = $idName;
        //
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.default-data-master');
    }
}
