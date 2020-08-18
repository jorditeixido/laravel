@extends('dashboard')

@section('body')

<h1>Crear Escuela</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'escuelas','files' => 'true')) }}

<div class="form-group">
        {{ Form::label('nombre', 'Nombre') }}
        {{ Form::text('nombre', old('nombre'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('direccion', 'Dirección') }}
        {{ Form::text('direccion', old('direccion'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        <div>
            <img src="{{ Storage::url('default_logotipo.jpg') }}" width="100" height="100">
        </div>
        {{ Form::label('logotipo', 'Logotipo') }}
        {{ Form::file('logotipo', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', old('email'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('telefono', 'Teléfono') }}
        {{ Form::text('telefono', old('telefono'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('paginaWeb', 'Pagina Web') }}
        {{ Form::text('paginaWeb', old('paginaWeb'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Registrar Escuela', array('class' => 'btn btn-primary')) }}
    {!! link_to('escuelas', 'Cancelar', ['class' => 'btn btn-danger']) !!}

{{ Form::close() }}

</div>

@endsection