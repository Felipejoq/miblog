<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function store(Post $post){

        $rules =[
            'photo' => 'required|image|max:2048'
        ];

        $this->validate(request(),$rules);

        $photo = request()->file('photo');
    }
}
