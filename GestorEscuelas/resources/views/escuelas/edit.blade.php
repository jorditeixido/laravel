@extends('dashboard')

@section('body')

<h1>Editar {{ $escuela->nombre }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($escuela, array('files' => 'true','route' => array('escuelas.update', $escuela->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('nombre', 'Nombre') }}
        {{ Form::text('nombre', $escuela->nombre, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('direccion', 'Dirección') }}
        {{ Form::text('direccion', $escuela->direccion, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        <div>
            <img src="{{ Storage::url($escuela->logotipo) }}" width="100" height="100">
        </div>
        {{ Form::label('logotipo', 'Logotipo') }}
        {{ Form::file('logotipo', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'email') }}
        {{ Form::email('email', $escuela->email, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('telefono', 'Teléfono') }}
        {{ Form::text('telefono', $escuela->telefono, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('paginaWeb', 'Página Web') }}
        {{ Form::text('paginaWeb', $escuela->paginaWeb, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Grabar Modificación', array('class' => 'btn btn-primary')) }}
    {!! link_to('escuelas', 'Cancelar', ['class' => 'btn btn-danger']) !!}

{{ Form::close() }}

</div>

@endsection