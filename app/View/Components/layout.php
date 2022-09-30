<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Main layout of the JobBoard pages
 */
class layout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?string $title)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout');
    }
}
