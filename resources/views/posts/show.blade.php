@extends('layout')

@section('meta-title',$post->title . " - Blog")
@section('meta-content',$post->excerpt)

@section('contenido')

    <article class="post container">

        @include( $post->viewType() )

        <div class="content-post">
            <header class="container-flex space-between">
                <div class="date">
                    <span class="c-gris">{{ optional($post->published_at)->format('d M Y') }} / {{ $post->owner->name }}</span>
                </div>
                @if($post->category)
                    <div class="post-category">
                        <span class="category text-capitalize"><a href="{{ route('category.show', $post->category) }}">{{ $post->category->name }}</a></span>
                    </div>
                @endif
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
@endpush
