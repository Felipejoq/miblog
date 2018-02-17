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
                    <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                    @foreach($roles as $id => $name)
                        <div class="checkbox">
                            <label>
                                <input name="roles[]" type="checkbox" value="{{ $id }}" {{ $user->roles->contains($id) ? 'checked' : '' }}/>
                                {{ $name }}
                            </label>
                        </div>
                    @endforeach
                        <button class="btn btn-primary btn-block">Actualizar roles</button>
                    </form>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permisos de usuario</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('admin.users.permissions.update', $user) }}">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                        @foreach($permissions as $id => $name)
                            <div class="checkbox">
                                <label>
                                    <input name="permissions[]" type="checkbox" value="{{ $name }}"
                                            {{ $user->permissions->contains($id) ? 'checked' : '' }}/>
                                    {{ $name }}
                                </label>
                            </div>
                        @endforeach
                        <button class="btn btn-primary btn-block">Actualizar permisos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection