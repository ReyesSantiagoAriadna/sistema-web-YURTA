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

        $request->validate([
            'razon_social'=>'required',
            'telefono'=>'required',
            'direccion'=>'required'
        ]);
        $proveedores = App\Proveedor::all();
        $proveedor = new App\Proveedor;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->telefono = $request->telefono;
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
        $proveedorActualizar->direccion = $request->direccion;
        $proveedorActualizar->save();
        $proveedores = App\PRoveedor::all();
        return view('proveedores.mostrar', compact('proveedores'))->with('mensaje', 'Proveedor Actualizado');
    }

    public function eliminar($id){
        $proveedorEliminar = App\Proveedor::findOrFail($id);
        $proveedorEliminar->delete();

        return back()->With('mensaje', 'Proveedor Eliminado');
    }
}
