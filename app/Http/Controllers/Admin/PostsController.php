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

        $post = Post::create($request->only('title'));

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
        $post->body = $request->get('body');
        $post->iframe = $request->get('iframe');
        $post->excerpt = $request->get('excerpt');

        $post->category_id = Category::find($cat = $request->get('category'))
                                    ? $cat
                                    : Category::create(['name' => $cat])->id;

        $post->published_at = $request->has('published_at') ? Carbon::instance(new \DateTime($request->publised_at)) : null;

        $post->save();

        $tags = [];

        foreach ($request->get('tags') as $tag) {

            $tags[] = Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;

        }

        $post->tags()->sync($tags);


        return redirect()
            ->route('admin.posts.edit',compact('post'))
            ->with('flash','Tu publicación ha sido guardada!');

    }

}
