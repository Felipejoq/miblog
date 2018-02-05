@extends('admin.layout')

@section('header')

    <h1>
        Crear un post
        <small>Formulario para crear post</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Crear Post</li>
    </ol>

@stop

@section('content')
    <div class="row">
        <form action="{{route('admin.posts.store')}}" method="POST">
            {{  csrf_field() }}
            <div class="col-md-8">
                <div class="box box-primary">
                    <!-- /.box-header -->

                    <div class="box-body">

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">Titulo del post</label>
                            <input value="{{ old('title') }}" id="title" name="title" type="text" class="form-control" placeholder="Escribe el título del post..." />
                            {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label for="body">Contenido del post</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="10" placeholder="Escribe el contenido del post...">
                                {{ old('body') }}
                            </textarea>
                            {!! $errors->first('body','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Fecha de publicación:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input value="{{ old('published_at') }}" type="text" class="form-control pull-right" id="datepicker" name="published_at">
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label>Selecciona una categoría:</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Selecciona una categoría...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                            <label>Etiquetas:</label>
                            <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Seleccione etiquetas..."  style="width: 100%;">
                                @foreach($tags as $tag)
                                <option value="{{$tag->id}}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>{{$tag->name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('tags','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                            <label for="excerpt">Resumen del post</label>
                            <textarea class="form-control" name="excerpt" id="excerpt" cols="30" rows="2" placeholder="Escribe el resumen del post...">{{ old('excerpt') }}</textarea>
                            {!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Guardar Publicación</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')

    <!-- CK Editor -->
    <script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

    <script>
        //Initialize Select2 Elements
        $('.select2').select2();
    </script>

    <script>
        $(function () {
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
            //Editor texto enriquecido
            CKEDITOR.replace('body');
        });
    </script>

@endpush
