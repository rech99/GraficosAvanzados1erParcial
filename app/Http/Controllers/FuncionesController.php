<?php

namespace App\Http\Controllers;

use App\Funcion;

use Illuminate\Http\Request;

class FuncionesController extends Controller
{
    public function index() {
        $funciones = Funcion::all();
        $argumentos = array();
        $argumentos['funciones'] = $funciones;

        return view('funciones.index',$argumentos);
    }


    public function create(){
        return view('funciones.create');

    }


    public function store(Request $request){
        $nuevaFuncion = new Funcion();
        $nuevaFuncion->pelicula = $request->input('pelicula');
        $nuevaFuncion->fecha = $request->input('fecha');
        $nuevaFuncion->hora = $request->input('hora');

        if ($nuevaFuncion-> save()){
            return redirect() -> route('funciones.index')-> with('success', 'Variant was added succesfully');
        }

        return redirect() -> route('funciones.index') -> with ("error", "Could not add variant");
    }


    public function destroy($id){
        $funcion = Funcion::find($id);

        if($funcion){
            //Si la encuentra la borra
            if($funcion->delete()){
                return redirect()->route('funciones.index')->with ('success', 'Variant deleted');
            }

            return redirect()->route('funciones.index')->with('error', 'Could not delete variant');
        }

        return redirect()->route('funciones.index')->with('error', 'Could not find variant');

    }

}
