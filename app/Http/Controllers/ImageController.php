<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $path = str_replace('public', '/storage', $request->file('file')->store('public/tmp-images'));
        $destination = public_path($path);
        $img = Image::make($destination)->resize(730, 410, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save();
        return $path;
    }
}
