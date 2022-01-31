<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show(Image $image)
    {
        if(Storage::missing($image->path)) {
            abort(404);
        }

        $file = Storage::get($image->path);


    }
}
