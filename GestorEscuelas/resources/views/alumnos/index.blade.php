@extends('dashboard')

@section('body')

<h2>Listado de Alumnos</h2>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td><b>ID</b></td>
                <td>
                    <b>
                    Nombre<br/>
                    Apellidos
                    </b>
                </td>
                <td><b>Fecha Nacimiento</b></td>    
                <td><b>Ciudad</b></td>
                <td><b>Escuela</b></td>
                <td>
                    <b>Acciones</b><br/>
                    <a href="{{ URL::to('alumnos/create') }}" class="btn btn-info btn-small">Crear un Alumno</a>
                </td>
            </tr>
        </thead>
        <tbody>
        @foreach($alumnos as $key => $alumno)
            <tr>
                <td><b>{{ $alumno->id }}</b></td>
                <td>
                    <b>{{ $alumno->nombre }}</b><br/>
                    {{ $alumno->apellidos }}
                </td>
                <td>{{ $alumno->fechaNacimiento }}</td>
                <td>{{ $alumno->ciudad }}</td>
                <td>{{ $alumno->escuela->nombre }}</td>
                <td>
                    {{ Form::open(array('url' => 'alumnos/' . $alumno->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Borrar', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                    <!-- edit this Escuela (uses the edit method found at GET /Alumnos/{id}/edit -->
                    <a class="btn btn-info btn-small" href="{{ URL::to('alumnos/' . $alumno->id . '/edit') }}">Editar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $alumnos->render() !!}

</div>

@endsection