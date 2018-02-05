<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    public function index(){

        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));

    }

    public function create(){

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact(['categories','tags']));

    }

    public function store(Request $request){

        //Validación

        $rules = [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'excerpt' => 'required'
        ];

        $this->validate($request,$rules);


        $post = new Post;
        $post->title = $request->get('title');
        $post->url = str_slug($request->get('title'),'-');
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        $post->category_id = $request->get('category');
        $post->published_at = $request->has('published_at') ? Carbon::instance(new \DateTime($request->publised_at)) : null;

        $post->save();

        $post->tags()->attach($request->get('tags'));


        return back()->with('flash','Tu publicación ha sido creada!');

    }

}
