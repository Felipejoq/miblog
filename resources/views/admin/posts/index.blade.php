@extends('admin.layout')

@section('header')

    <h1>
        Todos los posts del blog
        <small>Lista de artículos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Posts</li>
    </ol>

@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Listado de publicaciones</h3>

            <button type="button"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    class="btn btn-primary pull-right">
                <i class="fa fa-edit"></i> Crear nuevo post
            </button>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Resumen</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->excerpt }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                @endforeach

                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@stop

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush

@push('scripts')

    <!-- DataTables -->
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <!-- page script -->
    <script>
        $(function () {
            $('#posts-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });
        });
    </script>

@endpush