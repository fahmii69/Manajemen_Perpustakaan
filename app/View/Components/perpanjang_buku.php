<?php

namespace App\View\Components;

use Illuminate\View\Component;

class perpanjang_buku extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $item)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.perpanjang_buku');
    }
}
