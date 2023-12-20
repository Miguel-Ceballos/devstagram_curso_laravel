<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    public static function store(Request $request)
    {
        $image = $request->file('file');

        $imageName = Str::uuid() . "." . $image->extension();

        $manager = new ImageManager(new Driver());

        $imageServer = $manager->read($image);
        $imageServer->cover(1000, 1000);

        $imagePath = public_path('uploads') . '/' . $imageName;
        $imageServer->toJpeg()->save($imagePath);


        return response()->json([ 'image' => $imageName ]);
    }
}
