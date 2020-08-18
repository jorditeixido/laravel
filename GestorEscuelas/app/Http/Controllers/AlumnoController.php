<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\Escuela;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Html\HtmlFacade;
use Validator;
use Session;
use Redirect;

class AlumnoController extends Controller
{
    /**
     * Force guest authentication.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // get all the Alumnos except soft Deleted
       $alumnos = Alumno::orderBy('apellidos','ASC')
                    ->where('deleted_at', '=', NULL)
                    ->paginate(); 

       // get all the Escuelas
       $escuelas = Escuela::all();

       // load the view and pass the Alumnos and Escuelas
       return View::make('alumnos.index')
                ->with('alumnos', $alumnos)
                ->with('escuelas',$escuelas);
    }

    public function create()
    {
        $escuelas = Escuela::orderBy('nombre','ASC')
                        ->where('deleted_at', '=', NULL)
                        ->paginate(1000);
        /*
        PARA TECNOBRAVO
        He probado varias opciones de consulta (all() y pluck() entre
        otras) pero solo con orderBy() me lo ordena y aún así no me 
        funciona sin el paginate. Finalmente he optado por mostrar 1000
        elementos (sabiendo que hay 50)
        No me gusta la opción, pero es el último detalle para finalizar
        el ejercicio.
        SELECT id, nombre FROM `escuelas` WHERE deleted_at is NULL ORDER BY nombre
        */

        // load the create form (app/views/alumnos/create.blade.php)
        return View::make('alumnos.create')
                ->with('escuelas', $escuelas);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $rules = $this->rules();
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) 
        {
            return Redirect::to('alumnos/create')
                    ->withErrors($validator);
        }
        else
        {
            // store
            $alumno = new Alumno;
            $alumno->nombre            = request('nombre');
            $alumno->apellidos         = request('apellidos');
            $alumno->fechaNacimiento   = request('fechaNacimiento');
            $alumno->ciudad            = request('ciudad');
            $alumno->escuela_id        = request('escuela_id');    
            $alumno->save();

            // redirect
            Session::flash('message', 'Escuela creada correctamente!!!');
            return Redirect::to('alumnos');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the alumno
        $alumno = Alumno::find($id);
        $escuelas = Escuela::orderBy('nombre','ASC')
                        ->where('deleted_at', '=', NULL)
                        ->paginate(1000);

        // show the edit form and pass the alumno
        return View::make('alumnos.edit')
                ->with('alumno', $alumno)
                ->with('escuelas', $escuelas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        $rules = $this->rules();
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) 
        {
            return Redirect::to('alumnos/' . $id . '/edit')
                    ->withErrors($validator);
        } 
        else 
        {
            // store
            $alumno = Alumno::find($id);
            $alumno->nombre            = request('nombre');
            $alumno->apellidos         = request('apellidos');
            $alumno->fechaNacimiento   = request('fechaNacimiento');
            $alumno->ciudad            = request('ciudad');
            $alumno->escuela_id        = request('escuela_id');
            $alumno->save();

            // redirect
            Session::flash('message', 'Alumno modificada correctamente!!!');
            return Redirect::to('alumnos');
        }
    }
    
    public function destroy($id)
    {
        // delete
        $alumno = Alumno::find($id);
        $alumno->delete();

        // redirect
        Session::flash('message', 'Alumno Borrado!!!');
        return Redirect::to('alumnos');
    }

    /**
     * Set de rules for this ModelController.
     *
     * @return rules
     */
    public function rules()
    {
        $rules = array(
            'nombre'            => 'required|string',
            'apellidos'         => 'required|string',
            'fechaNacimiento'   => 'required|date|before:today',
            'ciudad'            => 'string',
            'escuela_id'        => ''
        );
        
        return $rules;
    }
}