<div class="gallery-photos" data-masonry='{ "itemSelector": ".grid-item","columnWidth":464 }'>
    @foreach($post->photos->take(4) as $photo)
        <figure class="gallery-image grid-item grid-item--height2">
            @if($loop->iteration === 4)
                <div class="overlay"><p><a href="blog/{{$post->url}}">{{ $post->photos->count() }} Fotos</a></p></div>
            @endif
            <img src="{{ url($photo->url) }}" alt="">
        </figure>
    @endforeach
</div>