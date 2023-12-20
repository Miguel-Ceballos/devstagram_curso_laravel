<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->request->add([ 'username' => Str::slug($request->username) ]);

        $this->validate($request, [
            'username' => [ 'required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20' ],
        ]);

        if ( $request->image ) {
            $image = $request->file('image');

            $imageName = Str::uuid() . "." . $image->extension();

            $manager = new ImageManager(new Driver());

            $imageServer = $manager->read($image);
            $imageServer->cover(1000, 1000);

            $imagePath = public_path('profiles') . '/' . $imageName;
            $imageServer->toJpeg()->save($imagePath);
        }

        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->image = $imageName ?? auth()->user()->image ?? null;
        $user->save();

        return redirect()->route('dashboard', $user->username);
    }

}
