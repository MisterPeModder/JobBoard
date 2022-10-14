<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    /**
     * fillable values
     */
    protected $fillable = [
        'advert_id',
        'applicant_id',
        'content',
        'status',
    ];

    /**
     * Get the advertisements associated with the application.
     */
    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }

    /**
     * Get the user associated with the application.
     */
    public function applicant()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the assets that were attached to this job application.
     */
    public function attachments()
    {
        return $this->belongsToMany(Asset::class, 'application_attachments', 'application_id', 'asset_id');
    }
}
