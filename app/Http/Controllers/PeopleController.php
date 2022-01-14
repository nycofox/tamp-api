<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function getPopular($limit = 10): array
    {
        $people = Person::orderBy('popularity', 'DESC')->limit($limit)->get();

        return $this->result($people);
    }

    public function getBirthday($date = null, $limit = 10): array
    {
        if (!$date) {
            $date = Carbon::now();
        } else {
            $date = Carbon::createFromFormat('Y-m-d', $date);
        }

        $people = Person::whereMonth('birthday', '=', $date->month)
            ->whereDay('birthday', '=', $date->day)
            ->orderBy('popularity', 'DESC')->limit($limit)->get();

        return $this->result($people);
    }

    private function result($people): array
    {
        return [
            'results' => $people->count(),
            'timestamp' => now(),
            'people' => $people,
        ];
    }
}
