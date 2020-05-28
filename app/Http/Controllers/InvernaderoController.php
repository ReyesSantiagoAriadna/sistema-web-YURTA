<?php

namespace App\Http\Controllers; 
 
use Illuminate\Http\Request;

use App\Z_Productos;
use App\Z_Pedido;
use App\Z_DetallePedido;

class InvernaderoController extends Controller{
    
    public function mostrar_productos(){
        $productos = Z_Productos::select('id','idCultivo','nombre','equiKilos','precioMay','precioMen',
        'cantExis', 'url_imagen')->get();
        return response()->json(['productos' => $productos]);
    }

    public function  search(Request $request){
        $data = $request->data;

        if($data!= ''){
            $productos = Z_Productos::
                select('id','idCultivo','nombre','equiKilos','precioMay','precioMen',
                'cantExis','url_imagen')
                ->where('nombre', 'like', "%{$data}%")
                ->get();

            if (count($productos)>0){
                return Response()->json([
                    'productos' => $productos
                ]); 
            }

            return Response()->json([
                'message' => 'no hay resultados'
            ]);
        }

        return Response()->json([
            'message' => 'no hay resultados'
        ]); 
    }

    public function find_items(Request $request){
        $productos = $request->productos;
        $models = Z_Productos::
            select('id','idCultivo','nombre','equiKilos','precioMay','precioMen',
            'cantExis','url_imagen')
            ->whereIn('id', $productos)->get();
        return response()->json(['productos'=>$models]);
    }

    public function mostrar_pedidos(){   
        $pedidos = Z_Pedido::join('users', 'z_pedido.id_cliente', '=', 'users.id')
        ->select('z_pedido.id','users.name','z_pedido.fechaSolicitud','z_pedido.fechaSurtido') 
        ->where('z_pedido.estatus','=', 1)
        ->get();
        return response()->json(['pedidos'=>$pedidos]);
    }

    public function editar_buscar($id){ 
        $pedido = Z_Pedido::findOrFail($id);
        return response()->json(['pedido' => $pedido]);
    }

    public function agregar_pedido(Request $request){ 
         $pedidoNuevo = new Z_Pedido();
         $pedidoNuevo->id_cliente = $request->id_cliente;
         $pedidoNuevo->fechaSolicitud = $request->fechaSolicitud;
         $pedidoNuevo->fechaSurtido = $request->fechaSurtido;
         $pedidoNuevo->estatus = $request->estatus; 
         $pedidoNuevo->total = $request->total;
         $pedidoNuevo->save(); 
 
         return response()->json([
             'id' =>$pedidoNuevo->id,
             'id_cliente'=>$pedidoNuevo->id_cliente,
             'fechaSolicitud' => $pedidoNuevo->fechaSolicitud,
             'fechaSurtido' => $pedidoNuevo->fechaSurtido,
             'estatus'=>$pedidoNuevo->estatus,
             'total'=>$pedidoNuevo->total,
         ]);
     } 

    public function actualizar_pedido(Request $request, $id){ 
        $pedidoActualizado = Z_Pedido::findOrFail($id);
        $pedidoActualizado->id_cliente = $request->id_cliente;
        $pedidoActualizado->fechaSolicitud = $request->fechaSolicitud;
        $pedidoActualizado->fechaSurtido = $request->fechaSurtido;
        $pedidoActualizado->estatus = $request->estatus;
        $pedidoActualizado->total = $request->total;
        $pedidoActualizado->save(); 
        
        return response()->json(['pedido actualizado']);
          
    }


    public function pedidoDetalles(Request $requets){       
          $filters = json_decode(file_get_contents("php://input"), true); 
          $pedido = $requets->id_pedido;
          $productos= $filters['productos'];
          $data;

  
         foreach ($productos as $key => $value) {
             $data[] = [
                        'idPedido' => $pedido,
                        'nombreProducto'    => $value['nombreProducto'], 
                        'cantidad'  => $value['cantidad'],
                        'idProducto' => $value['idProducto'],
                        'unidadM' => $value['unidadM'],
                        'precioUnitario' => $value['precioUnitario'],
                        'subtotal' => $value['subtotal'],
                      ];
          } 
  
          Z_DetallePedido::insert($data);
          return response()->json(['pedido y detalles agregados' => $productos ]);
          
      }
  
      public function eliminar_pedido($id){  
              $pedidoEliminar = Z_Pedido::findOrFail($id);
              $pedidoEliminar->delete(); 
          return response()->json(['pedido eliminado']);
      }
}