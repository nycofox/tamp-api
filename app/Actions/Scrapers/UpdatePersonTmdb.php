<?php

namespace App\Actions\Scrapers;

use App\Models\Alias;
use App\Models\Person;
use Tmdb\Laravel\Facades\Tmdb;

class UpdatePersonTmdb
{

    public static function updatePopular()
    {
        $people = Tmdb::getPeopleApi()->getPopular();

        if($people) {
            foreach($people['results'] as $person)
            {
                self::updatePerson($person['id']);
            }
        }
    }

    public static function updatePerson($tmdbid)
    {
        $tmdb = Tmdb::getPeopleApi()->getPerson($tmdbid);

        $person = Person::updateOrCreate(['tmdb_id' => $tmdbid], [
            'imdb_id' => $tmdb['imdb_id'],
            'name' => $tmdb['name'],
            'birthday' => $tmdb['birthday'] ?? null,
            'deathday' => $tmdb['deathday'] ?? null,
            'biography' => $tmdb['biography'] ?? null,
            'homepage' => $tmdb['homepage'] ?? null,
            'place_of_birth' => $tmdb['place_of_birth'] ?? null,
            'popularity' => $tmdb['popularity'] ?? 0,
            'tmdb_last_scraped_at' => now(),
        ]);

        foreach($tmdb['also_known_as'] as $alias)
        {
            Alias::updateOrCreate(['person_id' => $person->id, 'alias' => $alias]);
        }

    }

}
