@extends('dashboard')

@section('body')

<h1>Editar {{ $alumno->nombre }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($alumno, array('route' => array('alumnos.update', $alumno->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('nombre', 'Nombre') }}
        {{ Form::text('nombre', $alumno->nombre, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('apellidos', 'Apellidos') }}
        {{ Form::text('apellidos', $alumno->apellidos, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('fechaNacimiento', 'Fecha Nacimiento') }}
        {{ Form::date('fechaNacimiento', $alumno->fechaNacimiento, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('ciudad', 'Ciudad') }}
        {{ Form::text('ciudad', $alumno->ciudad, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('escuela_id', 'Selecciona la Escuela') }}
        <select name="escuela_id">
            @foreach($escuelas as $escuela)
                <option value="{{ $escuela->id }}"
                    @if($alumno->escuela_id == $escuela->id)
                        selected
                    @endif
                    >{{ $escuela->nombre }}
                </option> 
            @endforeach
        </select>
    </div>

    {{ Form::submit('Grabar Modificación', array('class' => 'btn btn-primary')) }}
    {!! link_to('alumnos', 'Cancelar', ['class' => 'btn btn-danger']) !!}

{{ Form::close() }}

</div>

@endsection