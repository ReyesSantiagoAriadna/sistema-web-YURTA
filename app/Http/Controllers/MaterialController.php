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

        $data = App\Material::select('proveedor.razon_social', 'categories.nameCategory')
            ->join('categories', 'users.idUser', '=', 'categories.user_id')
            ->get();

        return $data;
        // $materiales = App\Material::all();
       // return view('materiales.mostrar', compact('materiales'));
    }

    public function agregar(){
        $proveedores = App\Proveedor::all();
        return view('materiales.agregar', compact('proveedores'));
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
