<?php


namespace App\Http\Controllers\Api;


use App\DetallePedido;
use App\Material;
use App\MaterialObra;
use App\Obra;
use App\Pedido;
use App\TipoObra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use PhpParser\Node\Stmt\TryCatch;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function obras(Request $request){
        $id = $request->id;
        $response['obras']=Obra::
            join('tipo','obra.tipo_obra','=','tipo.id')
            ->select('obra.id','obra.descripcion','lat','lng','fech_ini','fech_fin','dependencia','tipo_obra','tipo.descripcion as tipo_descripcion')
        ->where('encargado',"=",$id)->get();
        return $response;
        //return response()->json('obra'=>[$consulta=]);
    }

    public function tiposObra(){
        $response['tiposobra'] = TipoObra::select('id','descripcion')->get();
        return $response;
    }
    public function materiales(){
        $response['materiales']=Material::
            join('tipo_material','material.tipo','=','tipo_material.id')
            ->join('unidad_material','material.unidad','=','unidad_material.id')
            ->select('material.id','material.descripcion','unidad_material.descripcion as unidad'
            ,'tipo_material.descripcion as tipo','marca','precio_unitario','url_imagen')
        ->get();
        return $response;
    }


    public function almacen(Request $request){
        $obra = $request->id;
        $result = Material::where('materiales_obra.id_obra',$obra)
            ->join('materiales_obra', 'material.id', '=', 'materiales_obra.mat_obra')
            ->select('material.id','material.descripcion','material.unidad'
                ,'material.tipo','material.marca','materiales_obra.cantidad','materiales_obra.id_obra','material.url_imagen')
            ->get();
        $response['materiales'] = $result;
        return response()->json($response);
    }

    public function pedidos(Request $request){
        $id_obra = $request->id;
        return response()->json($consulta=Pedido::select('*')->get()->
        where('obra',"=",$id_obra));
    }


    public function det_pedido(Request $request){
        $pedido = $request->id;
        $result = Material::select('descripcion')
            ->join('det_ped', 'det_ped.ped_material', '=', 'material.id')
            ->where('det_ped.id_pedido',$pedido)
            ->get();
        return response()->json($result);
    }
    public function usuarios(){
        return response()->json($consulta=User::select('*')->get());
    }

    public function login(Request $request){
       $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)){
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }

        $response['usuario']=Auth::user();
        return response()->json([
            'id' =>Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telefono'=>Auth::user()->telefono,
            'puesto'=>Auth::user()->puesto,
            'api_token' =>Auth::user()->api_token,
            'url_avatar'=>Auth::user()->url_avatar
        ]);
    }

    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        try {
            JWTAuth::invalidate($request->input('token'));
            return response([
                'status' => 'success',
                'msg' => 'You have successfully logged out.'
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response([
                'status' => 'error',
                'msg' => 'Failed to logout, please try again.'
            ]);
        }
    }



    public function refresh(){
        return response([
            'status' => 'success'
        ]);
    }

    public function user(Request $request){
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }


    //apis consultadas
    public function obrasAlmacen(Request $request){
        $encargado = $request->id;

        $response['almacenes']=
            Obra::where('encargado',"=",$encargado)
                ->join('materiales_obra', 'obra.id', '=', 'materiales_obra.id_obra')
                ->join('material','materiales_obra.mat_obra','=','material.id')
                ->join('tipo_material','material.tipo','=','tipo_material.id')
                ->join('unidad_material','material.unidad','=','unidad_material.id')
                ->select('materiales_obra.id_obra as id_obra'
                    ,'materiales_obra.mat_obra as material_id','material.descripcion as material_descripcion'
                ,'unidad_material.descripcion as material_unidad'
                    ,'tipo_material.descripcion as material_tipo'
                    ,'material.marca as material_marca','materiales_obra.cantidad as material_cantidad',
                    'material.url_imagen')
                ->get();
        return $response;
    }


    public function obrasPedidos(Request $request){
        $empleado = $request->id;
        $response=
            Obra::where('encargado',"=",$empleado)
            ->join('pedido','obra.id','=','pedido.obra')
            ->select('pedido.id','pedido.fecha_p','pedido.fecha_conf','pedido.estado','pedido.obra')
            ->get();
        $error=false;
        if($response->isEmpty())
            $error=true;
        //return response()->json(['pedidos'=>$response,'error'=>$error]);
        return response()->json(['pedidos'=>$response]);
    }


    public function detallesPedidos(Request $request){
        $empleado = $request->id;
        $response=
            Obra::where('encargado',"=",$empleado)
                ->join('pedido','obra.id','=','pedido.obra')
                ->join('det_ped','pedido.id','=','det_ped.id_pedido')
                ->join('material','det_ped.ped_material','=','material.id')
                ->select('det_ped.cantidad','det_ped.id_pedido','det_ped.ped_material as id_material',
                    'material.descripcion','material.unidad','material.marca','material.url_imagen')
                ->get();
        $error=false;
        if($response->isEmpty())
            $error=true;
       // return response()->json(['det_pedidos'=>$response,'error'=>$error]);

        return response()->json(['det_pedidos'=>$response]);
    }


    public function addPedido(Request $request){
        $status_default='0';

        $pedidoNuevo = new Pedido(); //Carbon::now('America/Montreal');;
       // $pedidoNuevo->fecha_p = Carbon::now('America/Chicago');
        $pedidoNuevo->fecha_p = Carbon::now('America/Mexico_City')->toDateString();
        $pedidoNuevo->fecha_conf = $request->fecha_conf;
        $pedidoNuevo->estado = $status_default;
        $pedidoNuevo->obra = $request->obra;
        $pedidoNuevo->save();

        return response()->json([
            'id' =>$pedidoNuevo->id,
            'fecha_p' => $pedidoNuevo->fecha_p,
            'fecha_conf' => $pedidoNuevo->fecha_conf,
            'estado'=>$pedidoNuevo->estado,
            'obra'=>$pedidoNuevo->obra
        ]);
    }

    public function addDetallePedido(Request $request){
       // $detalle = new DetallePedido();
        //$detalle->cantidad = $request->cantidad;
        //$detalle->id_pedido = $request->id_pedido;
        //$detalle->ped_material = $request->id_material;
        //$detalle->save();
        //$detalles = $request->detalles_pedido;
       // $input['can_material'] = $request->input('detalles_pedido.0.cantidad');
        $str='llega';
       /* $request['items']->each(function($item, $key) use ($str){

            $str  = $item;
        });
*/

        return response()->json(['str'=>$str]);
    }
}


/*
 * Obra::where('encargado',"=",$id)
                ->join('materiales_obra', 'obra.id', '=', 'materiales_obra.id_obra')
                ->join('material','materiales_obra.mat_obra','=','material.id')
                ->select('obra.id as obra_id','obra.descripcion as obra_descripcion',
                        'obra.lat as obra_lat','obra.lng as obra_lng','obra.fech_ini as obra_fech_ini'
                    ,'obra.dependencia as obra_dependencia','obra.encargado as obra_encargado',
                    'obra.tipo_obra as obra_tipo_obra','materiales_obra.id_obra as material_id_obra'
                    ,'materiales_obra.mat_obra as material_id','material.descripcion as material_descripcion'
                ,'material.unidad as material_unidad','material.tipo as material_tipo'
                    ,'material.marca as material_marca','materiales_obra.cantidad as material_cantidad')
                ->get();
 *
 * */


/*rules_version = '2';
service cloud.firestore {
  match /databases/{database}/documents {
    match /{document=**} {
      allow read, write: if false;
    }
  }
}
 * */