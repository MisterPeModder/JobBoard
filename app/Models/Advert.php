<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\JobType;
use App\Enums\SalaryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory; //package needed to create fake data

    /**
     * fillable values
     */
    protected $fillable = [
        'title',
        'full_description',
        'short_description',
        'location',
        'job_type',
        'salary_min',
        'salary_max',
        'salary_type',
        'salary_currency',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'job_type' => JobType::class,
        'salary_type' => SalaryType::class,
        'salary_currency' => Currency::class,
    ];

    /**
     * Get the company associated with the advertisement.
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
