<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function mostrar(){
        $proveedores = App\Proveedor::all();
        return view('proveedores.mostrar', compact('proveedores'));
    }

    public function agregar(){
        return view('proveedores.agregar');
    }

    public function crear_proveedores(Request $request){ 

      /*  $request->validate([
            'razon_social'=>'required',
            'telefono'=>'required',
            'email' => 'required',
            'direccion'=>'required'
        ]);*/
        $proveedores = App\Proveedor::all();
        $proveedor = new App\Proveedor;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->direccion = $request->direccion;
                
        $proveedor->save();
        return back()->with('mensaje','Proveedor agregado correctamente');
    }

    public function editar($id){
        $proveedor = App\Proveedor::findOrFail($id);
        return view('proveedores.editar',compact('proveedor'));
    }

    public function update(Request $request, $id){
        $proveedorActualizar = App\Proveedor::find($id);
        $proveedorActualizar->razon_social = $request->razon_social;
        $proveedorActualizar->telefono = $request->telefono;
        $proveedorActualizar->email = $request->email;
        $proveedorActualizar->direccion = $request->direccion;
        $proveedorActualizar->save();
        $proveedores = App\Proveedor::all();
        return view('proveedores.mostrar', compact('proveedores'))->with('mensaje', 'Proveedor Actualizado');
    }


    public function eliminar($id){
        $proveedorEliminar = App\Proveedor::findOrFail($id);
        $proveedorEliminar->delete();
    }

    public function edit($id){
        if(request()->ajax()) {
            $data = App\Proveedor::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
    public function updateProveedor(Request $request){
        $proveedorActualizar = App\Proveedor::findOrfail($request->hidden_id);
        $proveedorActualizar->razon_social = $request->razon_social;
        $proveedorActualizar->telefono = $request->telefono;
        $proveedorActualizar->direccion = $request->direccion;
        $proveedorActualizar->save();
        return response()->json(['success' => 'Registro Actualizado']);
    }


    public function proveedores(Request $request){
        if ($request->ajax()) {
            $proveedores = App\Proveedor::all();
            return response()->json($proveedores);
        }
    }
}
