<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escuela;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Html\HtmlFacade;
use Validator;
use Session;
use Redirect;
use Storage;

class EscuelaController extends Controller
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
       // get all the Escuelas
       $escuelas = Escuela::orderBy('nombre','ASC')
                    ->where('deleted_at','=', NULL)
                    ->paginate(); 
       
       // load the view and pass the Escuelas
       return View::make('escuelas.index')
                ->with('escuelas', $escuelas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/escuelas/create.blade.php)
        return View::make('escuelas.create');
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
            return Redirect::to('escuelas/create')
                    ->withErrors($validator);
        } 
        else 
        {
            // store
            $escuela = new Escuela;
            $escuela->nombre        = request('nombre');
            $escuela->direccion     = request('direccion');
            $escuela->email         = request('email');
            $escuela->telefono      = request('telefono');
            $escuela->paginaWeb     = request('paginaWeb');
            //image managment
            if ($request->hasFile('logotipo'))
            {
                $escuela->logotipo      = $request->file('logotipo')->store('public');
            }
            else 
            {
                $escuela->logotipo      = Storage::url('default_logotipo.jpg');
            }
            //save
            $escuela->save();

            // redirect
            Session::flash('message', 'Escuela creada correctamente!!!');
            return Redirect::to('escuelas');
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
        // get the escuela
        $escuela = Escuela::find($id);

        // show the edit form and pass the escuela
        return View::make('escuelas.edit')
                ->with('escuela', $escuela);
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
            return Redirect::to('escuelas/' . $id . '/edit')
                    ->withErrors($validator);
        } 
        else 
        {
            // store
            $escuela = Escuela::find($id);
            $escuela->nombre        = request('nombre');
            $escuela->direccion     = request('direccion');
            $escuela->email         = request('email');
            $escuela->telefono      = request('telefono');
            $escuela->paginaWeb     = request('paginaWeb');
            //image managment
            if ($request->hasFile('logotipo'))
            {
                $escuela->logotipo      = $request->file('logotipo')->store('public');
            }
            //save
            $escuela->save();

            // redirect
            Session::flash('message',' Escuela modificada correctamente!!!');
            return Redirect::to('escuelas');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $escuela = Escuela::find($id);
        /*
        PARA TECNOBRAVO
        Por simplicidad del ejercicio he evitado borrar escuelas que
        puedieran tener alumnos
        //$escuela->delete();
        En un proyecto real habría calculado y mostrado, por ejemplo, 
        los alumnos inscritos en cada escuela, igualmente mostraría
        o no el botón de borrar solo en caso de que no hubiera alumnos. 
        */
        $escuela->deleted_at    = date('Y-m-d H:i:s');
        $escuela->save();

        // redirect
        Session::flash('message', 'Escuela Borrada!!!');
        return Redirect::to('escuelas');
    }
    
    /**
     * Set de rules for this ModelController.
     *
     * @return rules
     */
    public function rules()
    {
        $rules = array(
            'nombre'     => 'required',
            'direccion'  => 'required',
            'logotipo'   => 'image|max:2048|dimensions:min_width=200,min_height=200',
            'email'      => 'email',
            /*
            PARA TECNOBRAVO:
            He definido una limitación simbólica al teléfono sin
            contemplar teléfonos fijo, solo por jugar con validation
            */
            'telefono'   => 'numeric|between:600000000,799999999',
            'paginaWeb'  => 'active_url'
        );
        
        return $rules;
    }
}
