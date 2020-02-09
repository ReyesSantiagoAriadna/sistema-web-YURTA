<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsuarioController extends Controller
{
    public function inicio(){
        $usuarios=User::all();
        return view('usuarios.mostrar',['usuarios'=>$usuarios]);
    }

    public function agregar(){
        return view('usuarios.agregar');
    }

    public function add(Request $request){
        $usuario=new User();
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        $usuario->password=Hash::make($request->password);
        $usuario->telefono=$request->telefono;
        $usuario->puesto=$request->puesto;
        $usuario->api_token=Str::random(60);

        $usuario->save();

       // return view()->with('mensaje','Registro agregado');

        $usuarios=User::all();
        return view('usuarios.mostrar',['usuarios'=>$usuarios])->with('mensaje','Registro agregado');
    }

    public function  editar($id){
        $usuario=User::findOrfail($id);
        return view('usuarios.editar',['usuario'=>$usuario]);
    }
    public function update(Request $request,$id){
        $usuarioUpdate=User::findOrfail($id);
        $usuarioUpdate->name=$request->name;
        $usuarioUpdate->email=$request->email;
        $usuarioUpdate->telefono=$request->telefono;
        $usuarioUpdate->puesto=$request->puesto;
        $usuarioUpdate->save();
        return back()->with('mensaje','registro actualizado');
    }

    public function eliminar($id){
        $usuarioEliminar=User::findOrfail($id);
        $usuarioEliminar->delete();
        return back()->with('mensaje','Registro eliminado');
    }
}