<?php

namespace App\View\Components;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

/**
 * Page button list.
 */
class PageNavigation extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public LengthAwarePaginator $paginator, public int $width, public string $class = '')
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
