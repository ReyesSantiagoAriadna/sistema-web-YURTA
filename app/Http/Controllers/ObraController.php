<?php
namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
class ObraController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function mostrar(){
        $obras = App\Obra::all();
        return view('obras.mostrar', compact('obras'));
    }
    public function agregar(){
        $usuarios = App\User::all();
        $tipos = App\TipoObra::all();
        return view('obras.agregar',['usuarios'=>$usuarios,'tipos'=>$tipos]);
    }

    public function add(Request $request){
        $obra=new App\Obra();
        $obra->descripcion=$request->descripcion;
        $obra->lat=$request->lat;
        $obra->lng=$request->lng;
        $obra->fech_ini=$request->fech_ini;
        $obra->dependencia=$request->dependencia;
        $obra->encargado=$request->encargado;
        $obra->tipo_obra=$request->tipo;
        $obra->save();
        $obras=App\Obra::all();
        return view('obras.mostrar',['obras'=>$obras])->with('mensaje','Registro agregado');
    }

    public function editar($id){
        $tipos=App\TipoObra::all();
        $usuarios= App\User::all();
        $obra = App\Obra::findOrFail($id);
        return view('obras.editar', compact('obra','tipos','usuarios'));
    }

    public function update(Request $request,$id){
        $obra = App\Obra::find($id);
        $obra->descripcion = $request->descripcion;
        $obra->lat = $request->lat;
        $obra->lng = $request->lng;
        $obra->fech_ini = $request->fech_ini;
        $obra->dependencia = $request->dependencia;
        $obra->encargado = $request->encargado;
        $obra->tipo_obra = $request->tipo;
        $obra->save();
        $obras = App\Obra::all();
        return view('obras.mostrar', compact('obras'));
    }
}