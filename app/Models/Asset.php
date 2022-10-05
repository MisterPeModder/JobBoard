<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * Get the owner user of this asset.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the owner company of this asset.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the associated blob.
     */
    public function blob()
    {
        return $this->belongsTo(Company::class);
    }
}
