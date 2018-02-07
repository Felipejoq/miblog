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

        $rules = [
            'title' => 'required'
        ];

        $this->validate($request,$rules);

        $post = Post::create([
            'title' => $request->get('title'),
            'url' => str_slug($request->get('title'),'-')
        ]);

        return redirect()->route('admin.posts.edit',compact('post'));

    }

    public function edit(Post $post){

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact(['post','categories','tags']));
    }

    public function update(Post $post, Request $request){

        //Validación

        $rules = [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'excerpt' => 'required'
        ];

        $this->validate($request,$rules);

        $post->title = $request->get('title');
        $post->url = str_slug($request->get('title'),'-');
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        $post->category_id = $request->get('category');
        $post->published_at = $request->has('published_at') ? Carbon::instance(new \DateTime($request->publised_at)) : null;

        $post->save();

        $post->tags()->sync($request->get('tags'));


        return redirect()
            ->route('admin.posts.edit',compact('post'))
            ->with('flash','Tu publicación ha sido guardada!');

    }

}
