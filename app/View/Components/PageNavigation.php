<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Page button list.
 */
class PageNavigation extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public int $max, public int $current, public int $width)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page-navigation');
    }
}
