<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'path',
        'tmdb_path',
    ];

    protected $appends = [
        'url'
    ];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'shortpath';
    }

    public function getUrlAttribute($minutes = 1)
    {
        return Storage::temporaryUrl($this->path, now()->addMinutes($minutes));
    }

}
