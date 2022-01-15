<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'birthday' => 'datetime:Y-m-d',
        'deathday' => 'datetime:Y-m-d',
        'tmdb_last_scraped_at' => 'datetime'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'age',
    ];

    protected $with = [
        'aliases'
    ];

    /**
     * Returns age if known, years alive if dead or "Unknown" if no dates
     *
     * @return string
     */
    public function getAgeAttribute(): string
    {
        if(!$this->birthday) {
            return 'Unknown';
        }

        if($this->deathday)
        {
            return '(' . $this->birthday->year . ' - ' . $this->deathday->year . ')';
        }

        return $this->birthday->age;
    }

    public function aliases()
    {
        return $this->hasMany(Alias::class);
    }
}
