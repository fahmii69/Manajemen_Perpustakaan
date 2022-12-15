<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tombol_addBack_form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $back,
        public string $status
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
        return view('components.tombol_kembali_tambah_form');
    }
}
