<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Response;
class TipoMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function mostrar(){
        $tipoMaterial = App\MaterialTipo::all(); 
        $unidadMaterial = App\MaterialUnidad::all();
        return view('tipoMaterial.mostrar', compact('unidadMaterial','tipoMaterial'));
    }

    public function agregar(){ 
        return view('tipoMaterial.agregar');
    }

    public function crear_tipo(Request $request){  
        $tipoNuevo = new App\MaterialTipo;
        $tipoNuevo->descripcion = $request->tipo;       
        $tipoNuevo->save();   
        return $this->mostrar()->with('mensaje','Registro agregado');
    }
  

    public function editTipo($id){
        if(request()->ajax()) {
            $data = App\MaterialTipo::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function add_tipo(Request $request){ 
        $tipoNuevo = new App\MaterialTipo;
        $tipoNuevo->descripcion = $request->descripcion;     
        $tipoNuevo->save();    
        return response()->json(['success' => 'Registro Agregado']);

    }
 
    public function updateTipo(Request $request){
        $tipoActualizar = App\MaterialTipo::findOrfail($request->hidden_id); 
        $tipoActualizar->descripcion = $request->descripcion;
        $tipoActualizar->save();
        return response()->json(['success' => 'Registro Actualizado']);
    }

    public function eliminar($id){
        $tipoEliminar = App\MaterialTipo::findOrFail($id);
        $tipoEliminar->delete();
    }
}
