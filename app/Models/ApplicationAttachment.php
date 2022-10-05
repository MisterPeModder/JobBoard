<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationAttachment extends Model
{
    use HasFactory;

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
