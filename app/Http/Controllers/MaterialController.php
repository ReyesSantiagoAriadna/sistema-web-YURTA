<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function mostrar(){
        $materiales = App\Material::all();
        $proveedores = App\Proveedor::all();
        return view('materiales.mostrar', compact('materiales','proveedores'));
    }
 
    public function agregar(){
        $proveedores = App\Proveedor::all();
        return view('materiales.agregar');
    }

    public function crear_material(Request $request){ 
        $materiales = App\Material::all();

        $materialNuevo = new App\Material;
        $materialNuevo->descripcion = $request->descripcion;
        $materialNuevo->unidad = $request->unidad;
        $materialNuevo->tipo = $request->tipo;
        $materialNuevo->marca = $request->marca;
        $materialNuevo->existencias = $request->existencias;
        $materialNuevo->precio_unitario = $request->precio_unitario;
        $materialNuevo->proveedor = $request->proveedor;

        $materialNuevo->save();

        return back()->with('mensaje', 'Material agregado correctamente');
    }

    public function editar($id){
        $proveedores = App\Proveedor::all();
        $material = App\Material::findOrFail($id);
        return view('materiales.editar', compact('material','proveedores'));
    }

    public function update(Request $request,$id){
        $materialActualiza = App\Material::find($id);
        $materialActualiza->descripcion = $request->descripcion;
        $materialActualiza->unidad = $request->unidad;
        $materialActualiza->tipo = $request->tipo;
        $materialActualiza->marca = $request->marca;
        $materialActualiza->existencias = $request->existencias;
        $materialActualiza->precio_unitario = $request->precio_unitario;
        $materialActualiza->proveedor = $request->proveedor;
        $materialActualiza->save();
        return back()->with('mensaje','Material Actializado');
    }

    public function eliminar($id){
        $materialEliminar = App\Material::findOrFail($id);
        $materialEliminar->delete();

        return back()->with('mensaje','Material Eliminado');
    }
    
}
