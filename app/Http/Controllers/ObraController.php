<?php
namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class ObraController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function mostrar(){
        $obra = App\Obra::all();
        return view('obras.mostrar', compact('obra'));
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
       // return view('obras.editar',['obra'=>$obra,'usuarios'=>$usuarios,'tipos'=>$tipos]);
    }
}