<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Response;
class UnidadMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function mostrar(){ 
        $unidadMaterial = App\MaterialUnidad::all();
        return view('unidadMaterial.mostrar', compact('unidadMaterial'));
    }
 
    public function agregar(){ 
        return view('unidadMaterial.agregar');
    }

    public function crear(Request $request){  
        $unidadNueva = new App\MaterialUnidad;
        $unidadNueva->descripcion = $request->unidad; 
        $unidadNueva->save();
        return $this->mostrar()->with('mensaje','Registro agregado');
    }

    
    public function edit($id){
        if(request()->ajax()) {
            $data = App\MaterialUnidad::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
 

    public function update(Request $request){
        $unidadActualizada = App\MaterialUnidad::findOrfail($request->hidden_id); 
        $unidadActualizada->descripcion = $request->descripcion;
        $unidadActualizada->save();
        return response()->json(['success' => 'Registro Actualizado']);
    }

    public function eliminarUnidad($id){
        $unidadEliminar = App\MaterialUnidad::findOrFail($id);
        $unidadEliminar->delete();
    }

    public function eliminar($id){
        $UnidadEliminar = App\MaterialUnidad::findOrFail($id);
        $UnidadEliminar->delete();
    }
}
