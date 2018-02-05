<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $dates = ['published_at'];

    public function getRouteKeyName()
    {
        return 'url';
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

}
