@extends('dashboard')

@section('body')

<h1>Crear Alumno</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'alumnos')) }}

<div class="form-group">
        {{ Form::label('nombre', 'Nombre') }}
        {{ Form::text('nombre', old('nombre'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('apellidos', 'Apellidos') }}
        {{ Form::text('apellidos', old('apellidos'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('fechaNacimiento', 'Fecha Nacimiento') }}
        {{ Form::date('fechaNacimiento', old('fechaNacimiento'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('ciudad', 'Ciudad') }}
        {{ Form::text('ciudad', old('ciudad'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('escuela_id', 'Selecciona una Escuela') }}
        <select name="escuela_id">
            @foreach($escuelas as $escuela)
            <option value="{{ $escuela->id }}">{{ $escuela->nombre }}</option> 
            @endforeach
        </select>
    </div>

    {{ Form::submit('Registrar Alumno', array('class' => 'btn btn-primary')) }}
    {!! link_to('alumnos', 'Cancelar', ['class' => 'btn btn-danger']) !!}

{{ Form::close() }}

</div>

@endsection