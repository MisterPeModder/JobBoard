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
        'description'
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
        return $this->hasOne(Blob::class);
    }

}
