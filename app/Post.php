<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'iframe', 'excerpt', 'category_id', 'published_at', 'user_id'
    ];

    protected $dates = ['published_at'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($post){
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    public static function create(array $attributes = []){

        $attributes['user_id'] = auth()->id();
        $post = static::query()->create($attributes);
        $post->generateURL();

        return $post;

    }

    public function generateURL(){
        $url = str_slug($this->title);

        if ($this->where('url',$url)->exists()){
            $url = "{$url}-{$this->id}";
        }

        $this->url = $url;

        $this->save();
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

    public function scopeAllowed($query){

        if (auth()->user()->can('view', $this)){
            return $query;
        }

        return $query->where('user_id', auth()->id());

    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
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

    public function isPublished(){

        return ! is_null($this->published_at && $this->published_at < today());
    }

    public function viewType($home = ''){
        if($this->photos->count() === 1):
            return 'posts.photo';
        elseif($this->photos->count() >= 1):
            return $home === 'home' ? 'posts.gallery ' : 'posts.carousel';
        elseif($this->iframe):
            return 'posts.iframe-post';
        else:
            return 'posts.text';
        endif;
    }

}
