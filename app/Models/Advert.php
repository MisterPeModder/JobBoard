<?php

namespace App\Models;

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
        'description'
    ];

    /**
     * Get the company associated with the advertisement.
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
