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

    public function agregar(Request $request){
        $tipo=new App\TipoObra();
        $tipo->descripcion=$request->descripcion;
        $tipo->save();



        //$tipos=App\TipoObra::all();
        //return view('tipo_obra.mostrar',['tipo'=>$tipos])->with('mensaje','Registro agregado');
    }

    public function  editar($id){
        $tipo=App\TipoObra::findOrfail($id);
        return view('tipo_obra.editar',['tipo'=>$tipo]);
    }
    public function update(Request $request,$id){
        $tipoUpdate=App\TipoObra::findOrfail($id);
        $tipoUpdate->descripcion=$request->descripcion;
        $tipoUpdate->save();
        $tipos=App\TipoObra::all();
        return view('tipo_obra.mostrar',['tipo'=>$tipos])->with('mensaje','Registro actualizado');
    }

    public function eliminar($id){
        $tipoEliminar=App\TipoObra::findOrfail($id);
        $tipoEliminar->delete();
        $tipos=App\TipoObra::all();
        return view('tipo_obra.mostrar',['tipo'=>$tipos])->with('mensaje','Registro actualizado');
    }


    public function tipos(Request $request){
        if ($request->ajax()) {
            $tipos = App\TipoObra::all();
            return response()->json($tipos);
        }
    }
}
