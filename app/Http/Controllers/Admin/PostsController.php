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

        $posts = auth()->user()->posts;

        return view('admin.posts.index', compact('posts'));

    }

    public function create(){

        $this->authorize('create', new Post);

        return view('admin.posts.create',[
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);

    }

    public function store(Request $request){

        $rules = [
            'title' => 'required|min:3'
        ];

        $this->validate($request,$rules);

        $post = Post::create($request->all());

        $post->save();

        return redirect()->route('admin.posts.edit',compact('post'));

    }

    public function edit(Post $post){

        $this->authorize('view', $post);

        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    public function update(Post $post, StorePostRequest $request){

        $this->authorize('update',$post);

        $post->update($request->all());
        $post->syncTags($request->get('tags'));

        return redirect()
            ->route('admin.posts.edit',compact('post'))
            ->with('flash','Tu publicación ha sido guardada!');

    }

    public function destroy(Post $post){

        $this->authorize('delete',$post);

        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('flash','La publicación ha sido eliminada!');


    }

}
