<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class for table users
class User extends Authenticatable implements MustVerifyEmail
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
     * The attributes that are not mass assignable.
     */
    protected $guarded = [
        'is_admin',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
    public function isMemberOf(?Company $company): bool
    {
        return $company !== null && $this->company_id === $company->id;
    }

    /**
     * Returns whether this user owns the given company.
     */
    public function owns(?Company $company): bool
    {
        return $company !== null && $company->owner_id === $this->id;
    }
}
