<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DefaultUploadFile extends Component
{
    public $nama;
    public $title;
    public $accept;
    public $document;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nama,$title,$accept = false,$document)
    {
        $this->nama = $nama;
        $this->title = $title;
        $this->accept = $accept;
        $this->document = $document;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.default-upload-file');
    }
}
