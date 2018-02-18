@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos personales</h3>
                </div>
                <div class="box-body">

                    @if($errors->any())
                        <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" value="{{old('name', $user->name)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" value="{{old('email', $user->email)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Editar contraseña:</label>
                            <input type="password" name="password" placeholder="Ingrese nueva contraseña" class="form-control">
                            <span class="help-block">Dejar en blanco si no quieres cambiar la contraseña.</span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Repita su contraseña:</label>
                            <input type="password" name="password_confirmation" placeholder="Repita su nueva contraseña" class="form-control">
                        </div>
                        <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles de usuario</h3>
                </div>
                <div class="box-body">

                    @role('Admin')
                        <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
                            {{ csrf_field() }} {{ method_field('PUT') }}
                            @include('admin.roles.checkboxes')
                            <button class="btn btn-primary btn-block">Actualizar roles</button>
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse($user->roles as $role)
                                <li class="list-group-item">{{ $role->name }}</li>
                            @empty
                                    <li class="list-group-item">No tiene roles asignados.</li>
                            @endforelse
                        </ul>

                    @endrole
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permisos de usuario</h3>
                </div>
                <div class="box-body">
                    @role('Admin')
                        <form method="POST" action="{{ route('admin.users.permissions.update', $user) }}">
                            {{ csrf_field() }} {{ method_field('PUT') }}
                            @include('admin.permissions.checkboxes')
                            <button class="btn btn-primary btn-block">Actualizar permisos</button>
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse($user->permissions as $permission)
                                <li class="list-group-item">{{ $permission->name }}</li>
                            @empty
                                <li class="list-group-item">No tiene permisos asignados.</li>
                            @endforelse
                        </ul>

                    @endrole
                </div>
            </div>
        </div>
    </div>

@endsection