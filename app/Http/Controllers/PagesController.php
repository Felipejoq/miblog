<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){

        $posts = Post::published()->paginate(5);

        return view('pages.home', compact('posts'));

    }

    public function show($id){

    }

    public function about(){

        return view('pages.about');
    }
    public function archive(){

        return view('pages.archive');
    }
    public function contact(){

        return view('pages.contact');
    }

}
