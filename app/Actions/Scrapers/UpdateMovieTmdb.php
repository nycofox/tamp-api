<?php

namespace App\Actions\Scrapers;

use App\Models\Movie;
use Tmdb\Laravel\Facades\Tmdb;

class UpdateMovieTmdb
{
    public static function updatePopular()
    {
        $movies = Tmdb::getMoviesApi()->getPopular();

        if($movies) {
            foreach($movies['results'] as $movies)
            {
                self::updateMovie($movies['id']);
            }
        }
    }

    public static function updateMovie($tmdbid)
    {
        $tmdb = Tmdb::getMoviesApi()->getMovie($tmdbid);

        $movie = Movie::updateOrCreate(['tmdb_id' => $tmdbid], [
            'imdb_id' => $tmdb['imdb_id'] ?? null,
            'tmdb_id' => $tmdb['id'],
            'original_language' => $tmdb['original_language'] ?? null,
            'original_title' => $tmdb['original_title'] ?? null,
            'overview' => $tmdb['overview'] ?? null,
            'popularity' => $tmdb['popularity'] ?? null,
            'release_date' => $tmdb['release_date'] ?? null,
            'revenue' => $tmdb['revenue'] ?? null,
            'runtime' => $tmdb['runtime'] ?? null,
            'status' => $tmdb['status'] ?? null,
            'title' => $tmdb['title'] ?? null,
            'tagline' => $tmdb['tagline'] ?? null,
            'vote_average' => $tmdb['vote_average'] ?? null,
            'vote_count' => $tmdb['vote_count'] ?? null,
            'budget' => $tmdb['budget'] ?? null,
            'homepage' => $tmdb['homepage'] ?? null,
            'tmdb_last_scraped_at' => now(),
        ]);
    }

}
