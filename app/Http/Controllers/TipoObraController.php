<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TipoObraController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function mostrar(){
        $tipo = App\TipoObra::all();
        return view('tipo_obra.mostrar', compact('tipo'));
    }

    public function agregar(){ 
        return view('tipo_obra.agregar');
 
    } 

    public function crear_tipo(Request $request){  
        $tipo_obra = new App\TipoObra;
        $tipo_obra->descripcion = $request->descripcion; 
        $tipo_obra->save();
        return $this->mostrar()->with('mensaje','Registro agregado');
    }
 

    public function edit($id){
        if(request()->ajax()) {
            $data = App\TipoObra::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request){
        $tipoUpdate=App\TipoObra::findOrfail($request->hidden_id); 
        $tipoUpdate->descripcion=$request->descripcion;
        $tipoUpdate->save();
        return response()->json(['success' => 'Registro Actualizado']);
    }

    public function eliminar($id){
        $tipoEliminar = App\TipoObra::findOrFail($id);
        $tipoEliminar->delete();
        return $this->mostrar();
    }

  
   
 
}
