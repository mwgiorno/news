<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('file')->store('public/images');
        return str_replace('public', '/storage', $path);
    }
}
