<?php

namespace App\Http\Controllers;

use http\Env\Response;
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
        $tipos = App\MaterialTipo::all();
        $unidades = App\MaterialUnidad::all();

        return view('materiales.mostrar', compact('materiales','proveedores','tipos','unidades'));

        /*$data = App\Material::select('proveedor.razon_social', 'categories.nameCategory')
            ->join('categories', 'users.idUser', '=', 'categories.user_id')
            ->get();*/


        // $materiales = App\Material::all();
       // return view('materiales.mostrar', compact('materiales'));
    }

    public static function countMateriales(){
        $materiales = App\Material::all()->count();
        return $materiales;
    }
 
    public function agregar(){
        $proveedores = App\Proveedor::all(); 
        $tipos = App\MaterialTipo::all();
        $unidades = App\MaterialUnidad::all();
        return view('materiales.agregar', compact('proveedores', 'tipos', 'unidades'));
    }

    public function crear_material(Request $request){ 


        $materialNuevo = new App\Material;
        $materialNuevo->descripcion = $request->descripcion;
        $materialNuevo->unidad = $request->unidad;
        $materialNuevo->tipo = $request->tipo;
        $materialNuevo->marca = $request->marca;
        $materialNuevo->existencias = $request->existencias;
        $materialNuevo->precio_unitario = $request->precio_unitario;
        $materialNuevo->proveedor = $request->proveedor;
        $materialNuevo->url_imagen=$request->url;


        $materialNuevo->save();
        $materiales = App\Material::all();

        return back()->with('mensaje','agregado');

        //return view('materiales.mostrar',compact('materiales'))->with('mensaje','Registro agregado');
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
        $materiales = App\Material::all();
        return view('materiales.mostrar',compact('materiales'))->with('mensaje','Material Actualizado');
    }

    
    public function eliminar($id){
        $materialEliminar = App\Material::findOrFail($id);
        $materialEliminar->delete();
    }



    public function edit($id){
        if(request()->ajax()) {
            $data = App\Material::findOrfail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function tipos(Request $request){
        if($request->ajax()){
            $tipos = App\MaterialTipo::all();
            return reponse()->json($tipos);
        }
    }

    public function unidades(Request $request){
        if($request->ajax()){
            $unidades = App\MaterialUnidad::all();
            return reponse()->json($unides);
        }
    }


    public function updateMaterial(Request $request){
        $materialActualiza = App\Material::find($request->hidden_id);
        $materialActualiza->descripcion = $request->descripcion;
        $materialActualiza->unidad = $request->unidad;
        $materialActualiza->tipo = $request->tipo;
        $materialActualiza->marca = $request->marca;
        $materialActualiza->existencias = $request->existencias;
        $materialActualiza->precio_unitario = $request->precio_unitario;
        $materialActualiza->proveedor = $request->proveedor;
        $materialActualiza->save();
        return response()->json(['success' => 'Registro Actualizado']);
    }
    
}
