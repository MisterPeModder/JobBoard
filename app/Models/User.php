<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class for table users
class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'name',
        'surname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
    ];
    //default values
    protected $attributes = [
        'name' => null,
        'surname' => null,
    ];

    /**
     * Get the company associated with the user.
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }
    /**
     * Get the icon (img) associated with the user.
     */
    public function icon()
    {
        return $this->hasOne(Blob::class);
    }
}
