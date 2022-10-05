<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blob extends Model
{
    use HasFactory;

    /**
     * fields non fillable
     */
    protected $guarded = [
        'name',
        'mime_type',
        'hash',
        'uuid',
        'access',
    ];

    /**
     * Get the owner associated with the blob.
     */
    public function owner()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the company associated with the blob.
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /**
     * Get all the assets that uses this blob.
     */
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
