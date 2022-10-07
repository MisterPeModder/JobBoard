<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationAttachment extends Model
{
    use HasFactory;

    /**
     * fillable values
     */
    protected $fillable = [
        'asset_id',
        'application_id',
    ];

    /**
     * Get the application associated with the application's attachment.
     */
    public function application()
    {
        return $this->hasOne(Application::class);
    }

    /**
     * Get the asset associated with the application's attachment.
     */
    public function asset()
    {
        return $this->hasOne(Asset::class);
    }
}
