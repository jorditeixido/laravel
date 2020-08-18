@extends('dashboard')

@section('body')

<h2>Listado de Escuelas</h2>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td><b>ID</b></td>
            <td><b>Logotipo</b></td>
            <td>
                <b>Nombre</b><br/>
                Teléfono<br/>
                email<br/>
            </td>
            <td><b>Dirección</b></td>
            <td><b>Página web</b></td>
            <td>
                <b>Acciones</b><br/>
                <a href="{{ URL::to('escuelas/create') }}" class="btn btn-info btn-small">Crear Escuela</span></a>
            </td>
        </tr>
    </thead>
    <tbody>
    @foreach($escuelas as $key => $value)
        <tr>
            <td><b>{{ $value->id }}</b></td>
            <td><img src="{{ Storage::url($value->logotipo) }}" width="100"></td>
            <td>
                <b>{{ $value->nombre }}</b><br/>
                {{ $value->telefono }}<br/>
                {{ $value->email }}
            </td>
            <td>{{ $value->direccion }}</td>
            <td><a href="{{ $value->paginaWeb }}" target="_blank">{{ $value->paginaWeb }}</a></td>
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the Escuela (uses the destroy method DESTROY /Escuelas/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'escuelas/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Borrar', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

                <!-- edit this Escuela (uses the edit method found at GET /Escuelas/{id}/edit -->
                <a class="btn btn-info btn-small" href="{{ URL::to('escuelas/' . $value->id . '/edit') }}">Editar</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $escuelas->render() !!}

</div>

@endsection