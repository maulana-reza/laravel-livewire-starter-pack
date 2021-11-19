<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BookCard extends Component
{
    public $image = false, $title, $subjek, $kategori;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image = false, $title, $subjek, $kategori)
    {
        $this->image = $image;
        $this->title = $title;
        $this->subjek = $subjek;
        $this->kategori = $kategori;

        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.book-card');
    }
}
