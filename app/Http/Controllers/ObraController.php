<?php
namespace App\Http\Controllers;
use App;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\ObrasRequest;

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

    public function add(ObrasRequest $request){
        $obra=new App\Obra();
        $obra->descripcion=$request->descripcion;
        $obra->lat=$request->lat;
        $obra->lng=$request->lng;
        $obra->fech_ini=$request->fech_ini;
        $obra->fech_fin=$request->fech_fin;
        $obra->dependencia=$request->dependencia;
        $obra->encargado=$request->encargado;
        $obra->tipo_obra=$request->tipo_obra;
        $obra->save();
        //$obras=App\Obra::all();
        //return view('obras.mostrar',['obras'=>$obras])->with('mensaje','Registro agregado');


        $materiales = App\Material::all();
        return view('obras.agregar_material',compact('obra','materiales'));
    }

    public function editar($id){
        $tipos=App\TipoObra::all();
        $usuarios= App\User::all();
        $obra = App\Obra::findOrFail($id);
        return view('obras.editar', compact('obra','tipos','usuarios'));
    }

    public function update(ObrasRequest $request,$id){
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
        return $this->mostrar()->with('mensaje','Obra eliminada');
    }

    public function agregar_material(){ 
        $obras = App\Obra::all();
        $materiales = App\Material::all();
        return view('obras.agregar_material', compact('obras','materiales')); 
   }

   public function crear_material_obra(Request $request){
       $material = $request->input('cantidades');
       $cantidad = $_POST['c2'];
       $id_obra = $request->input('obra');

       for ($i=0; $i < sizeof($material); $i++) {
           if($material[$i] != 0 && $cantidad[$i]){
               $material_obra = new App\MaterialObra;
               $material_obra->id_obra = $id_obra;
               $material_obra->cantidad = $cantidad[$i];
               $material_obra->mat_obra = $material[$i];
               $this->disminuir_existencias($material[$i],$cantidad[$i]);
               $material_obra->save();
           }
       }
       
       return $this->mostrar();
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


    public function detalle(){
        return view('obras.detalle');
    }


    public function detail(Request $request){
        $materiales =
            App\MaterialObra::join('material', 'materiales_obra.mat_obra',   '=', 'material.id')
            ->where('id_obra',$request->id)
            ->get();
        //
        $obra=App\Obra::findOrfail($request->id);

        $data =  App\User::join('obra', 'users.id', '=', 'obra.encargado')   
        ->where('obra.id', '=', $obra->id)
        ->get();   
 
        return view('obras.detalle', compact('obra','materiales','data'));
        //return view('obras.detalle',['obra'=>$detail,'materiales'=>$materiales_obra]);
        //return $detail;
    }
    //obtencion del material
    public function material(Request $request){
        $obra = $request->id;
        $materiales = App\Material::all();
        return view('obras.agregar_material',compact('obra','materiales'));
    }
    //inserccion y actualizacion
    public function agregarMaterial(Request $request){

    }

    function disminuir_existencias($id,$cantidad){
        $materialUpdate = App\Material::find($id);
        $total = $materialUpdate->existencias - $cantidad;
        $materialUpdate->existencias = $total;
        $materialUpdate->save();
    }


    public function ubicacion(){
        if(request()->ajax()) {
            $data = App\Obra::all();
            return response()->json(['result' => $data]);
        }
    }


    public function presupuesto(){
        $obras = App\Obra::all();
        $materiales =App\Material::all();
        return view('obras.presupuesto',compact('obras','materiales'));
    }

    public function materialObra($id){
        return App\MaterialObra::where('id_obra', $id)->get();
    }
}

/*
 *   $obra = App\Obra::join('users','obra.encargado','=','users.id')
            //->findOrfail($request->id)
            ->where('obra.id',$request->id)
            ->select('obra.*','users.name')
            ->get();
 * */