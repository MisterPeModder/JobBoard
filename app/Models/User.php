<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class for table users
class User extends Authenticatable
{
    use HasFactory;

    // timestamps of creation/update
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'name',
        'surname'
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password_hash',
        'password_salt',
    ];
    //default values
    protected $attributes = [
        'name' => null,
        'surname' => null,
        'password_hash' => null,
        'password_salt' => null
    ];


}
