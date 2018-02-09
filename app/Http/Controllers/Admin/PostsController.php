<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\StorePostRequest;
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

    public function update(Post $post, StorePostRequest $request){

//        $post->title = $request->get('title');
//        $post->body = $request->get('body');
//        $post->iframe = $request->get('iframe');
//        $post->excerpt = $request->get('excerpt');
//        $post->category_id = $request->get('category_id');
//        $post->published_at = $request->get('published_at');
//        $post->save();

        $post->update($request->all());
        $post->syncTags($request->get('tags'));

        return redirect()
            ->route('admin.posts.edit',compact('post'))
            ->with('flash','Tu publicación ha sido guardada!');

    }

}
