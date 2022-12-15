<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tombol_store extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $route,
        public string $title

    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tombol_store');
    }
}
