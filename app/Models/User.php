<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class for table users
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'name',
        'surname',
        'password',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //default values
    protected $attributes = [
        'name' => null,
        'surname' => null,
        'phone_number' => null,
    ];

    /**
     * Get the company associated with the user.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the icon (img) associated with the user.
     */
    public function icon()
    {
        return $this->hasOne(Asset::class);
    }

    /**
     * Get all the assets this user owns.
     */
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    /**
     * Get the applications that this user filed.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Returns whether this user is part of the given company.
     */
    public function isMemberOf(Company $company): bool
    {
        return $this->company_id === $company->id;
    }

    /**
     * Returns whether this user owns the given company.
     */
    public function owns(company $company): bool
    {
        return $company->owner_id == $this->id;
    }
}
