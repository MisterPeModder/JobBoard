<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\JobType;
use App\Enums\SalaryType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Advert extends Model
{
    use HasFactory, Searchable;

    /**
     * fillable values
     */
    protected $fillable = [
        'company_id',
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
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the applications to this advert.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the indexable data array for the model.
     */
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'full_description' => $this->full_description,
            'short_description' => $this->short_description,
            'job_type' => $this->job_type,
            'company_name' => $this->company->name,
        ];
    }

    /**
     * Performs a search against the model's searchable data.
     *
     * Similar to {@see query()}, but returns an Eloquent query builder instead.
     */
    public static function querySearch(string $query): QueryBuilder
    {
        $result = self::search($query)->get();
        if ($result->isEmpty()) {
            return self::where('id', null);
        } else {
            return $result->toQuery();
        }
    }
}
