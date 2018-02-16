@extends('admin.layout')

@section('header')

    <h1>
        USUARIOS
        <small>Lista de usuarios</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Usuarios</li>
    </ol>

@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Listado de usuarios</h3>

            <button type="button"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    class="btn btn-primary pull-right">
                <i class="fa fa-edit"></i> Crear nuevo usuario
            </button>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                        <td>
                            <a target="_blank" href="{{ route('admin.users.show', $user) }}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button class="btn btn-danger btn-xs" onclick="return confirm('¿Quieres eliminar el usuario?')"><i class="fa fa-times"></i></button>
                            </form>
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
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });
        });
    </script>

@endpush