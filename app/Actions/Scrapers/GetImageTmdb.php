<?php

namespace App\Actions\Scrapers;

use App\Models\Image;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GetImageTmdb
{

    public static function getImage($path)
    {
        if($image = Image::where('tmdb_path', $path)->first()) {
            return $image;
        }

        if(!$response = Http::get(config('tmdb.image_path') . $path)) {
            return false;
        }

        $shortpath = Str::random(15) . '.' . basename($response->header('Content-Type'));
        $storage_path = date('Y/m/d/') . $shortpath;

        if(!$storage = Storage::put($storage_path, $response->body())) {
            return false;
        }

        $image = Image::create([
            'path' => $storage_path,
            'shortpath' => $shortpath,
            'tmdb_path' => $path
        ]);

        return $image;
    }

}
