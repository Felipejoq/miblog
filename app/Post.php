<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'iframe', 'excerpt', 'category_id', 'published_at'
    ];

    protected $dates = ['published_at'];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function setTitleAttribute($title){
        $this->attributes['title'] = $title;
        $this->attributes['url'] = str_slug($title,'-');
    }

    protected function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query){

        $query->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now())
            ->orderby('published_at','desc');
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function setCategoryIdAttribute($category){
        $this->attributes['category_id'] = Category::find($category)
                                            ? $category
                                            : Category::create(['name' => $category])->id;
    }

    public function setPublishedAtAttribute($published_at){
        $this->attributes['published_at'] = $published_at
                                            ? Carbon::parse($published_at)
                                            : null;
    }

    public function syncTags($tags){
        $tagIds = collect($tags)->map(function ($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name'=>$tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }
}
