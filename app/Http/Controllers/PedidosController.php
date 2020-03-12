<?php

namespace App\Http\Controllers;

use App\Notifications\TaskCompleted;
use App\Notifications\NotificacionResidente;
use App\Obra;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;
use App;
use DB;

class PedidosController extends Controller
{ 
    public function __construct(){
        $this->middleware('auth');
    }


    public function view(){
        $result = App\Pedido::join('obra', 'pedido.obra',   '=', 'obra.id')
            ->join('users', 'obra.encargado', '=', 'users.id')
            ->select('pedido.*','obra.id', 'obra.descripcion','users.name')
            ->get();
        return $result;
    }



    public function mostrar(){
        $pedidos = App\Pedido::join('obra', 'pedido.obra',   '=', 'obra.id')
            ->join('users', 'obra.encargado', '=', 'users.id')
            ->select('pedido.*', 'obra.descripcion','users.name') 
            ->where('pedido.estado','=', 0)
            ->get();
        return view('pedidos.mostrar', compact('pedidos'));
    }

    public function agregar(){ 
        $obras = App\Obra::all();
        return view('pedidos.agregar', compact('obras'));
    }

    public function crear_pedido(Request $request){
        $pedidoNuevo = new App\Pedido;
        $pedidoNuevo->fecha_p = $request->fecha_p;
        $pedidoNuevo->fecha_conf = $request->fecha_conf;
        $pedidoNuevo->estado = $request->estado;
        $pedidoNuevo->obra = $request->obra;
        $pedidoNuevo->save();
        return back()->with('mensaje','Pedido agregado');
    }

    public function editar($id){
        $obras = App\Obra::all();
        $pedido = App\Pedido::findOrFail($id);
        return view('pedidos.editar', compact('pedido','obras'));
    }

    public function update(Request $request, $id){
        $pedidoActualizado = App\Pedido::find($id);
        $pedidoActualizado->fecha_p = $request->fecha_p;
        $pedidoActualizado->fecha_conf = $request->fecha_conf;
        $pedidoActualizado->estado = $request->estado;
        $pedidoActualizado->obra = $request->obra;
        $pedidoActualizado->save();
        $pedidos = App\Pedido::all();
        return view('pedidos.mostrar',compact('pedidos'))->with('mensaje','Pedido actualizado');
    }

    public function eliminar($id){
        $pedidoEliminar = App\Pedido::findOrFail($id);
        $pedidoEliminar->delete();
        return back()->with('mensaje','Pedido eliminado');
    }
    public static function countPedidos(){
        $pedidos = App\Pedido::where('estado',1)->count();
        return $pedidos;
    }

    public function detalle($id){
        $id_pedido=$id;
          $data =  DB::table('material')
        ->join('det_ped', 'det_ped.ped_material', '=', 'material.id')
        ->join('pedido', 'pedido.id', '=', 'det_ped.id_pedido')
        ->join('obra','obra.id','=','pedido.obra')
        ->select('material.descripcion', 'det_ped.cantidad', 'material.id','obra.descripcion as des_obra', 'obra.id as id_obra')
        ->where('pedido.id', '=', $id_pedido)
        ->get();  
        return view('pedidos.confirmarPedido', compact('data','id_pedido')); 
    }
 
    public function confirmarMaterial(Request $request){ 
        $id_pedido = $request->input('id_pedido'); 
        $ids_materiales = $_POST['ids_material'];
        $cantidades = $_POST['cantidades']; 
        $aDatos = null;
        $aCantidades= null; 
 
        for ($i=0; $i < sizeof($ids_materiales); $i++) {  
            $material = App\Material::find($ids_materiales[$i]);  
            if($material->existencias >= $cantidades[$i]){ 
                $aDatos[$i] = $material; 
                $aCantidades[$i] = $cantidades[$i];  
            }else{
                //echo "no entra";
                return back()->with('mensaje','No hay suficiente material');
            } 
        }
  
        return view('pedidos.detalleConfirmacion', compact('id_pedido','aDatos'))->with('aCantidades',$aCantidades);  
    }  
 
    public function confirmarPedido(Request $request){
        $id_pedido = $request->input('id_pedido'); 
        $ids_materiales = $_POST['ids_material'];
        $cantidades = $_POST['cantidades'];

       for ($i=0; $i < sizeof($ids_materiales) ; $i++) {
            $this->pedido_agregar_materia($id_pedido,$ids_materiales,$cantidades[$i],$ids_materiales[$i]); 
            $this->disminuir_existencias($ids_materiales[$i], $cantidades[$i]); 
        }
 

        $pedido= App\Pedido::find($id_pedido);
        $result = Obra::where('obra.id',$pedido->obra)
            ->join('users','users.id','=','obra.encargado')
            ->select('users.fcm_token','users.id as user','obra.id as obra')->get();
        $data = json_decode($result);
        $fcm_token= $data[0]->fcm_token;
        $user_id = $data[0]->user;
        $obra_id = $data[0]->obra;


        /** GENERAR PUSH NOTIFICATION->RESIDENTE**/
        $this->sendPushNotification($fcm_token,"Pedido confirmado"
           ,"Tu pedido se ha confirmado va en camino");
        $pedido = App\Pedido::find($id_pedido); 
       
        $pedido->estado= 1;
        $pedido->save();

        /** GENERAR DATABASE NOTIFICATION->RESIDENTE**/
        $titulo = 'Pedido';
        $tipo=1;  //NOTIFICACION TIPO PEDIDO
        $mensaje = 'se ha enviado tu pedido con id #' . $id_pedido;
        App\User::find($user_id)->notify(new NotificacionResidente($titulo,$tipo,$mensaje,$obra_id));


        
       
      /**   $obra_pedido = App\Pedido::find($id_pedido);  
        $obra_p =App\Obra::find($obra_pedido->obra); 
        $materiales_p;
        for ($i=0; $i < sizeof($ids_materiales); $i++) { 
            $materiales_p[$i] = App\Material::find($ids_materiales[$i]); 
        }  */ 
         
        return $this->mostrar();
    }

    public function vistaPDF($id_pedido, $ids_materiales, $cantidades){
        //datos de la pbra y materiales IMPRIMIR QR 
       
    }

    function disminuir_existencias($id,$cantidad){ 
        $total = 0;
        $material = App\Material::find($id);  
        $total = $material->existencias - $cantidad; 
        $material->existencias = $total;
        $material->save();
        if($material->existencias >0){
            $total = $material->existencias - $cantidad; 
            $material->existencias = $total;
            $material->save();
        }
        
           
 
    }

    public function pedido_agregar_materia($id,$materiales,$cantidad,$material){ 
        $obra_pedido = App\Pedido::find($id);  
        $obras_material = App\MaterialObra::where('id_obra',$obra_pedido->obra)                        
        ->get(); 
       
       /* for ($i=0; $i < sizeof($obras_material); $i++) {  
             if($obras_material[$i]->id_obra == $obra_pedido->obra){
                 if($obras_material[$i]->mat_obra == $material){
                    $obras_material[$i]->cantidad = $obras_material[$i]->cantidad + $cantidad;
                    $obras_material[$i]->save();                      
                 }
             }else{
                 echo "no existe";
             } 
        } */

        if(count($obras_material) >= 1) {                    
           for ($i=0; $i < sizeof($obras_material); $i++) {  
                if($obras_material[$i]->id_obra == $obra_pedido->obra){
                if($obras_material[$i]->mat_obra == $material){
                     $obras_material[$i]->cantidad +=  $cantidad;
                     $obras_material[$i]->save();                      
                 }
                } 
                     
                }
        } else {
           for ($i=0; $i < sizeof($materiales) ; $i++) {  
                $material_obra = new App\MaterialObra;
                $material_obra->id_obra = $obra_pedido->obra;
                $material_obra->cantidad = $cantidad;
                $material_obra->mat_obra = $materiales[$i]; 
                $material_obra->save(); 
            }
        }   
 
    }
    public function met()
    {
        $token = App\User::where('id','1')->select('users.fcm_token')->get();

        $this->sendPushNotification($token,'hola','hola');
        //return $token;
    }

    public  function sendPushNotification($fcm_token,$title,$message) {
        $id=null;
        $API_ACCESS_KEY="AIzaSyAUNcqTUttLsiBm9YCs344VbI5Wcil6BZ0";
        $url = "https://fcm.googleapis.com/fcm/send";
        $header = [
            'authorization: key=' . $API_ACCESS_KEY,
            'content-type: application/json'
        ];

        $postdata = '{
            "to" : "' . $fcm_token . '",
                "notification" : {
                    "title":"' . $title . '",
                    "text" : "' . $message . '"
                },
            "data" : {
                "id" : "'.$id.'",
                "title":"' . $title . '",
                "description" : "' . $message . '",
                "text" : "' . $message . '",
                "is_read": 0
              }
        }';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function qrPedido(Request $request){
        $id_pedido = $request->id;
        $var = App\DetallePedido::find($id_pedido);

        $pedidos = App\Pedido::find($id_pedido)
            ->join('obra', 'pedido.obra',   '=', 'obra.id')
            ->join('users', 'obra.encargado', '=', 'users.id')
            ->select('pedido.*', 'obra.descripcion','users.name')
            ->where('pedido.estado','=', 0)
            ->get();

            

        return $pedidos;
    }
}