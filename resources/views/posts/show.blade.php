@extends('layout')

@section('meta-title',$post->title . "- Blog")
@section('meta-content',$post->excerpt)

@section('contenido')

    <article class="post container">

        @if($post->photos->count() === 1)
            <figure><img src="{{ url($post->photos->first()->url) }}" class="img-responsive"></figure>
        @elseif($post->photos->count() >= 1)
            @include('partials.carousel')
        @elseif($post->iframe)
            <div class="video">
                {!! $post->iframe !!}
            </div>
        @endif

        <div class="content-post">
            <header class="container-flex space-between">
                <div class="date">
                    <span class="c-gris">{{ $post->published_at->format('d M Y') }}</span>
                </div>
                <div class="post-category">
                    <span class="category">{{ $post->category->name }}</span>
                </div>
            </header>
            <h1>{{ $post->title }}</h1>
            <div class="divider"></div>
            <p></p>
            <div class="image-w-text">
                {!! $post->body !!}
            </div>

            <footer class="container-flex space-between">
                @include('partials.social-buttons', ['description' => $post->title])
                <div class="tags container-flex">
                    @foreach($post->tags as $tag)
                    <span class="tag c-gris">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            </footer>
            <div class="comments">
                <div class="divider"></div>
                <div id="disqus_thread"></div>
                @include('partials.disqus')
            </div><!-- .comments -->
        </div>
    </article>

@endsection

@push('scripts')
    <script id="dsq-count-scr" src="http://zendero.disqus.com/count.js" async></script>
    <script src="/js/jquery-3.3.1.min.js"></script>
    <srcript src="/js/bootstrap.min.js"></srcript>
@endpush

@push('styles')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
@endpush
