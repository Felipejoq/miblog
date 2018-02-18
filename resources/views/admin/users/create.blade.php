@extends('admin.layout')

@section('content')
    <div class="row">

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear un usuario</h3>
                </div>
                <div class="box-body">

                    @if($errors->any())
                        <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Roles</label>
                            @include('admin.roles.checkboxes')
                        </div>
                        <div class="form-group col-md-6">
                            <label>Permisos</label>
                            @include('admin.permissions.checkboxes')
                        </div>
                        <span class="help-block col-md-12">La contraseña será generada automáticamente y enviada vía email al nuevo usuario.</span>
                        <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection