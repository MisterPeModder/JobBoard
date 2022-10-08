<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'owner_id',
        'icon_id',
    ];

    /**
     * Get the owner associated with the compay.
     */
    public function owner()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the icon associated with the user.
     */
    public function icon()
    {
        return $this->hasOne(Asset::class);
    }

    /**
     * Get all the assets this company owns.
     */
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }
}
