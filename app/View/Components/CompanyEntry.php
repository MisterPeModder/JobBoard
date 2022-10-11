<?php

namespace App\View\Components;

use App\Models\Company;
use Illuminate\View\Component;

class CompanyEntry extends Component
{
    public string $id;

    public string $name;

    public ?string $location = null;

    public string $description;

    public ?string $iconUrl = null;

    /**
     * Create a new component instance.
     */
    public function __construct(public Company $company)
    {
        $this->id = $company->id;
        $this->name = $company->name;
        $this->description = $company->description;

        if ($company->location !== null) {
            $this->location = $company->location;
        }

        $this->iconUrl = $company->icon?->getUrl();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.company-entry');
    }
}
