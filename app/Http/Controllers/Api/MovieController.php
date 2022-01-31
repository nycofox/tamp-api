<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function getPopular($limit = 10): array
    {
        $movies = Movie::orderBy('popularity', 'DESC')->limit($limit)->get();

        return $this->result($movies);
    }

    private function result($movies): array
    {
        return [
            'results' => $movies->count(),
            'timestamp' => now(),
            'movies' => $movies,
        ];
    }
}
