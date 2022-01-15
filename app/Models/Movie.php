<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $casts = [
        'tmdb_last_scraped_at' => 'datetime'
    ];

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
