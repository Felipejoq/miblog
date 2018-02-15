<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @foreach($post->photos as $photo)
            <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
        @endforeach
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @foreach($post->photos as $photo)
            <div class="item{{ $loop->first ? ' active' : '' }}">
                <img src="{{ url($photo->url) }}" title="{{ $post->title }}">
            </div>
        @endforeach
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>


@push('scripts')
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/twitter-bootstrap.js"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="/css/twitter-bootstrap.css">
@endpush