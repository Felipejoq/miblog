<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category){

        return view('pages.home',[
            'posts' => $category->posts()->paginate(5),
            'title' => "Post de la categoría: ". $category->name
        ]);
    }
}
