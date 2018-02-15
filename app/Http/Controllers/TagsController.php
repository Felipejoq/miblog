<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        return view('pages.home', [
            'posts' => $tag->posts()->paginate(5),
            'title' => "Post de la etiqueta: ". $tag->name
        ]);
    }
}
