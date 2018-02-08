<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Post $post){

        $rules =[
            'photo' => 'required|image|max:2048'
        ];

        $this->validate(request(),$rules);

        $photo = request()->file('photo')->store('public');

        Photo::create([
            'url' => Storage::url($photo),
            'post_id' => $post->id
        ]);
    }

    public function destroy(Photo $photo){

        $photo->delete();

        $photoURL = str_replace('storage','public',$photo->url);

        Storage::delete($photoURL);

        return back()->with('flash','¡Foto Eliminada con Éxcito!');
    }
}
