@extends('admin.layout')

@section('content')

    <h2>DASHBOARD RECIÉN CREADO</h2>

    Usuario auntentificado: {{ auth()->user()->name }}
@stop