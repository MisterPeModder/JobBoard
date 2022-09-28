<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JobAdvert extends Component
{
    /**
     * The title of this advert component.
     */
    public string $title;

    public string $company;

    public string $location;

    public string $shortDescription;

    public string $fullDescription;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $company
     * @param $location
     */
    public function __construct(
        string $title,
        string $company,
        string $location = "unknown location",
        string $shortDescription = "",
        string $fullDescription = ""
    ) {
        $this->title = $title;
        $this->company = $company;
        $this->location = $location;
        $this->shortDescription = $shortDescription;
        $this->fullDescription = $fullDescription;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.job-advert');
    }
}
