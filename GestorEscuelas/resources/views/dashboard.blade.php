@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Bienvenido {{ auth()->user()->name }}</h1>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('logout') }}">
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-xs btn-block">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark" style="margin-top: 10px;margin-bottom: 10px;">
  <ul class="navbar-nav">
    <li class="nav-item {{ Request::is('escuelas*') ? 'active' : '' }}">
      <a class="nav-link" href="/escuelas">Escuelas</a>
    </li>
    <li class="nav-item {{ Request::is('alumnos*') ? 'active' : '' }}">
      <a class="nav-link" href="/alumnos">Alumnos</a>
    </li>
  </ul>
</nav>
@yield('body')

@endsection
