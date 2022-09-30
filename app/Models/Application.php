<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'advert_id',
        'applicationattachement_id'
    ];

    /**
     * Get the advertisements associated with the application.
     */
    public function advertisements()
    {
        return $this->hasMany(Advert::class);
    }
    /**
     * Get the user associated with the application.
     */
    public function applicant()
    {
        return $this->hasOne(User::class);
    }

}
