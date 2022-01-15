<?php

namespace App\Actions\Scrapers;

use App\Models\Genre;
use Tmdb\Laravel\Facades\Tmdb;

class UpdateGenreTmdb
{

    /**
     *
     */
    public static function updateGenres()
    {
        $genres = Tmdb::getGenresApi()->getGenres();

        foreach ($genres['genres'] as $genre) {

            Genre::updateOrCreate(['id' => $genre['id']], [
                'id' => $genre['id'],
                'name' => $genre['name'],
                'tmdb_last_scraped_at' => now(),
            ]);
        }
    }
}
