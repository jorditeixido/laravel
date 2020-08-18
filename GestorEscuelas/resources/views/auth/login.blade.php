@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Acceso al Gestor de Escuelas</h1>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">email</label>
                            <input class="form-control" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   placeholder="Introduce tu email">
                            {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">Contraseña</label>
                            <input class="form-control" 
                                   type="password" 
                                   name="password" 
                                   placeholder="Introduce tu contraseña">
                            {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                        </div>
                        <button class="btn btn-primary btn-block">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection