<?php
namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
class ObraController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function view(){
        $result = App\Obra::join('users', 'obra.encargado',   '=', 'users.id')
            ->join('tipo', 'obra.tipo_obra', '=', 'tipo.id')
            ->select('obra.*', 'users.name', 'tipo.descripcion')
            ->get();
        return $result;
    }
    public function mostrar(){
        $obras = App\Obra::join('users', 'obra.encargado',   '=', 'users.id')
            ->join('tipo', 'obra.tipo_obra', '=', 'tipo.id')
            ->select('obra.*', 'users.name', 'tipo.descripcion')
            ->get();
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
        $obra->tipo_obra=$request->tipo_obra;
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
/*
    public function update(Request $request, $id){
        $obras = App\Obra::all();
        $obraActualizada = App\Obra::find($id);
        $obraActualizada->descripcion = $request->descripcion;
        $obraActualizada->lat=$request->lat;
        $obraActualizada->lng=$request->lng;
        $obraActualizada->fech_ini=$request->fech_ini;
        $obraActualizada->dependencia=$request->dependencia;
        $obraActualizada->encargado=$request->encargado;
        $obraActualizada->tipo_obra=$request->tipo;

        $obraActualizada->save();
        return view('obras.mostrar', compact('obras'))->with('mensaje','Obra Actualizada');
    }
*/
    public function eliminar($id){
        $obraElimnar = App\Obra::findOrFail($id);
        $obraElimnar->delete();

        return back()->with('mensaje','Obra eliminada');
    }

    public function agregar_material(){ 
        $obras = App\Obra::all();
        $materiales = App\Material::all();
        return view('obras.agregar_material', compact('obras','materiales')); 
   }

   public function crear_material_obra(Request $request){
       $material_obra = new App\MaterialObra;
       $material_obra->cantidad = $request->cantidad;
       $material_obra->id_obra = $request->id_obra;
       $material_obra->mat_obra = $request->mat_obra;
       $material_obra->save();

       return back()->with('mensaje','Material agregado');
   }

   public function mostrar_material_obra($id){
    $obra = App\Obra::findOrFail($id);
    $materiales_obra = App\MAterialObra::all();
    return view('obras.mostrar_materiales', compact('obra','materiales_obra'));
}

    public function edit($id){
        if(request()->ajax()) {
            $data = App\Obra::findOrfail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function updateObra(Request $request){
        $obra = App\Obra::find($request->hidden_id);
        $obra->descripcion = $request->descripcion;
        $obra->lat = $request->lat;
        $obra->lng = $request->lng;
        $obra->fech_ini = $request->fech_ini;
        $obra->dependencia = $request->dependencia;
        $obra->encargado = $request->encargado;
        $obra->tipo_obra = $request->tipo;
        $obra->save();
        return response()->json(['success' => 'Registro Actualizado']);
    }
    public function find_obra(Request $request){
        if ($request->ajax()) {
            $obra = App\Obra::find($request->id);
            return response()->json($obra);
        }
    }
}