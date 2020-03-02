<?php


namespace App\Http\Controllers;
 
use App\Http\Requests\UsersRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\Auth;


class UsuarioController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function countUsuarios(){
        $usuarios = User::all()->count();
        return $usuarios;
    }

    public function inicio(){
        $usuarios=User::all();
        return view('usuarios.mostrar',['usuarios'=>$usuarios]);
    }

    public function agregar(){
        return view('usuarios.agregar');
    }

    public function perfil(){
        return view('usuarios.perfil');
    }
    public function add(UsersRequest $request){
        $usuario=new User();
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        $usuario->password=Hash::make($request->password);
        $usuario->telefono=$request->telefono;
        $usuario->puesto=$request->puesto;
        $usuario->api_token=Str::random(60);
        $usuario->url_avatar=$request->url;
        $usuario->save();

       // return view()->with('mensaje','Registro agregado');

        $usuarios=User::all();
        return view('usuarios.mostrar',['usuarios'=>$usuarios])->with('mensaje','Registro agregado');
    }

    public function  editar($id){
        $usuario=User::findOrfail($id);
        return view('usuarios.editar',['usuario'=>$usuario]);
    }
    public function update(UsersRequest $request,$id){
        $usuarioUpdate=User::findOrfail($id);
        $usuarioUpdate->name=$request->name;
        $usuarioUpdate->email=$request->email;
        $usuarioUpdate->telefono=$request->telefono;
        $usuarioUpdate->puesto=$request->puesto;
        $usuarioUpdate->save();

       /* $usuarios=User::all();
        return view('usuarios.mostrar',['usuarios'=>$usuarios])->with('mensaje','registro actualizado');*/
    }

    public function eliminar($id){
        $usuarioEliminar=User::findOrfail($id);
        $usuarioEliminar->delete();
        //return back()->with('mensaje','Registro eliminado');
    }
    /*Metodos por ajax*/
    public function edit($id){
        if(request()->ajax()) {
            $data = User::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }


    public function update1(Request $request){
        $usuarioUpdate=User::findOrfail($request->hidden_id);
        $usuarioUpdate->name=$request->name;
        $usuarioUpdate->email=$request->email;
        $usuarioUpdate->telefono=$request->telefono;
        $usuarioUpdate->puesto=$request->puesto;
        $usuarioUpdate->save();
        return response()->json(['success' => 'Registro Actualizado']);
    }


    public function residentes(Request $request){
        if ($request->ajax()) {
            $residentes = User::all();
            return response()->json($residentes);
        }
    }

    public function configUpdate(Request $request,$id){
        $usuarioUpdate=User::findOrfail($id);
        $usuarioUpdate->name=$request->name;
        $usuarioUpdate->email=$request->email;
        $usuarioUpdate->telefono=$request->telefono;
        $usuarioUpdate->save();
        return back()->with('mensaje','Datos actualizados');
    }
}