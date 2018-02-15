@extends('layout')

@section('contenido')
    <section class="posts container">

        @if(isset($title))
            <div class="post">
                <div class="content-post category-title">
                    <h3>{{ $title }}</h3>
                </div>
            </div>
        @endif

        @if(isset($tag))
            <div class="post">
                <div class="content-post category-title">
                    <h3>&curlyeqsucc; Post de la etiqueta: {{ $tag->name }}.</h3>
                </div>
            </div>
        @endif

        @foreach( $posts as $post )

            <article class="post">

                @include( $post->viewType('home') )

                <div class="content-post">
                    <header class="container-flex space-between">
                        <div class="date">
                            <span class="c-gris">{{ $post->published_at->format('d M Y') }} / {{ $post->owner->name }}</span>
                        </div>
                        <div class="post-category">
                            <span class="category text-capitalize"><a href="{{ route('category.show', $post->category) }}">{{ $post->category->name }}</a></span>
                        </div>
                    </header>
                    <h1>{{ $post->title }}</h1>
                    <div class="divider"></div>
                    <p>{{ $post->excerpt }}</p>
                    <footer class="container-flex space-between">
                        <div class="read-more">
                            <a href="{{ route('posts.show',$post) }}" class="text-uppercase c-green">Leer más…</a>
                        </div>
                        <div class="tags container-flex">
                            @foreach($post->tags as $tag)
                                <span class="tag c-gris text-capitalize"><a href="{{route('tag.show', $tag)}}">#{{ $tag->name }}</a></span>
                            @endforeach
                        </div>
                    </footer>
                </div>
            </article>
        @endforeach
    </section><!-- fin del div.posts.container -->

    {{ $posts->links() }}

@stop

@push('scripts')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@endpush
