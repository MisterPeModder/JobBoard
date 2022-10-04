<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JobAdvert extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $id,
        public string $title,
        public string $company,
        public string $jobType,
        public ?string $icon = null,
        public string $location = 'unknown location',
        public string $shortDescription = '(no description)',
        public string $salary = 'unknown',
        public string $fullDescription = '(no description)'
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.job-advert');
    }
}
