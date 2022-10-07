<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Testing\MimeType;

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
        return $this->belongsTo(Blob::class);
    }

    /**
     * @return string The URL of this asset.
     */
    public function getUrl(): string
    {
        $extension = MimeType::search($this->mime_type);
        $extension = $extension == null ? '' : ".$extension";

        return url('/assets/'.$this->blob->uuid.$extension);
    }

    /**
     * Get the applications that use this asset as an attachment.
     */
    public function applications()
    {
        return $this->belongsToMany(Application::class, 'application_attachments', 'asset_id', 'application_id');
    }
}
