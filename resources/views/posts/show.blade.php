@extends('layout')

@section('meta-title',$post->title . "- Blog")
@section('meta-content',$post->excerpt)

@section('contenido')

    <article class="post image-w-text container">
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
                @include('partials.social-buttons')
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
@endpush