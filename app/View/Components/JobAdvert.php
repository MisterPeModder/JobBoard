<?php

namespace App\View\Components;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class JobAdvert extends Component
{
    public string $id;

    public string $title;

    public string $company;

    public string $companyUrl;

    public ?string $location = null;

    /**
     * @var array<int, string>
     */
    public array $shortDescription;

    public string $fullDescription;

    public ?string $jobType = null;

    public ?string $salaryMin = null;

    public ?string $salaryMax = null;

    public ?string $salaryType = null;

    public ?string $iconUrl = null;

    /**
     * A string that contains the list of actiosn the user can do on the current advert.
     * This list is used client-side to display additional buttons in the advert options dropdown.
     * 
     * Example: `" can-delete can-update"`
     */
    public String $permissions = '';

    /**
     * Create a new component instance.
     */
    public function __construct(public Advert $advert)
    {
        $this->id = $advert->id;
        $this->title = $advert->title;
        $this->company = $advert->company->name;
        $this->companyUrl = route('companies.show', $advert->company->id);
        $this->shortDescription = explode('\n', $advert->short_description);
        $this->fullDescription = $advert->full_description;

        if ($advert->location !== null) {
            $this->location = $advert->location;
        }

        if ($advert->job_type !== null) {
            $this->jobType = 'job_type.' . $advert->job_type->value;
        }

        if ($advert->salary_min !== null) {
            $formatter = new \NumberFormatter(App::getLocale(), \NumberFormatter::CURRENCY);
            $this->salaryMin = $formatter->formatCurrency($advert->salary_min, $advert->salary_currency->value);

            if ($advert->salary_min != $advert->salary_max) {
                $this->salaryMax = $formatter->formatCurrency($advert->salary_max, $advert->salary_currency->value);
            }
            $this->salaryType = 'salary_type.' . $advert->salary_type->value;
        }

        $this->iconUrl = $advert->company->icon?->getUrl();

        $this->permissions = self::collectPermissions(Auth::user(), $advert);
    }
    
    private static function collectPermissions(User $user, Advert $advert): string {
        $permissions = '';
        if ($user->can('delete', $advert)) {
            $permissions .= ' can-delete';
        }
        if ($user->can('update', $advert)) {
            $permissions .= ' can-update';
        }
        return $permissions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.job-advert');
    }
}
