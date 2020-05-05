<?php


namespace App\Http\Controllers\Api;


use App\DetallePedido;
use App\Material;
use App\MaterialObra;
use App\Notificaciones;
use App\Notifications\TaskCompleted;
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
use App\Producto;
use App\Promocion;
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

        $fcm_token = $request->fcm_token;


        User::where('id',Auth::user()->id)->update(array(
            'fcm_token'=>$fcm_token,
        ));


    
       // $response['usuario']=Auth::user();
        return response()->json([
            'id' =>Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telefono'=>Auth::user()->telefono,
            'puesto'=>Auth::user()->puesto,
            'api_token' =>Auth::user()->api_token,
            'url_avatar'=>Auth::user()->url_avatar,
            'fcm_token'=>$fcm_token
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
        $cantidades = $_POST['cantidad'];
        $material = $_POST['material'];
        $pedido = $request->pedido;
        $count = count($cantidades) ;
        for($i=0;$i<$count;$i++) {
            $detalle = new DetallePedido();
            $detalle->cantidad = $cantidades[$i];
            $detalle->id_pedido = $pedido;
            $detalle->ped_material = $material[$i];
            $detalle->save();
        }
        return response()->json(['succes'=>'succes']);
    }

    public function addPedidoDetails(Request $request){
        $status_default='0';
        $pedidoNuevo = new Pedido(); //Carbon::now('America/Montreal');;
        // $pedidoNuevo->fecha_p = Carbon::now('America/Chicago');
        $pedidoNuevo->fecha_p = Carbon::now('America/Mexico_City')->toDateString();
        $pedidoNuevo->fecha_conf = $request->fecha_conf;
        $pedidoNuevo->estado = $status_default;
        $pedidoNuevo->obra = $request->obra;
        $pedidoNuevo->save();

        $cantidades = $_POST['cantidad'];
        $material = $_POST['material'];
        //$pedido = $request->pedido;
        $count = count($cantidades) ;
        for($i=0;$i<$count;$i++) {
            $detalle = new DetallePedido();
            $detalle->cantidad = $cantidades[$i];
            $detalle->id_pedido = $pedidoNuevo->id;
            $detalle->ped_material = $material[$i];
            $detalle->save();
        }
        // return response()->json(['succes'=>'succes']);


        //generar database notificación
       // if($pedidoNuevo){
            $titulo = 'Pedido';
            $tipo=1;
            $mensaje = 'se ha realizado un nuevo pedido';
            $link = '/mostrar_pedidos';
            $administradores = User::where('puesto',"=",'gerente')->select('users.*')->get();
            foreach ($administradores as $admin){
                User::find($admin->id)->notify(new TaskCompleted($titulo,$tipo,$mensaje,$link));
            }
        //}
        return response()->json([
            'id' =>$pedidoNuevo->id,
            'fecha_p' => $pedidoNuevo->fecha_p,
            'fecha_conf' => $pedidoNuevo->fecha_conf,
            'estado'=>$status_default,
            'obra'=>$request->obra
        ]);

    }

    public function update_fcm_token(Request $request){
        $fcm_token = $request->fcm_token;
        $id = $request->id;

       $user= User::where('id', $id)
            ->update(['fcm_token'=>$fcm_token]);

      // return $user;
        $user = User::find($id);
        return response()->json([
            'id' =>$user->id,
            'name' => $user->name,
            'email' => $user->email,
            'telefono'=>$user->telefono,
            'puesto'=>$user->puesto,
            'api_token' =>$user->api_token,
            'url_avatar'=>$user->url_avatar,
            'fcm_token'=>$fcm_token
        ]);

    }

    //todas las notificaciones de un usuario
    public function notifications(Request $request){
        $notif['notificaciones'] = User::find($request->id)->unreadNotifications;
       /* $notificaciones = Notificaciones::where('notifiable_id',$request->id)
            ->select('id','data')->get();*/
        return $notif;
    }

    //contar las notificaciones de un usuario
    public function countNotificationsUnread(Request $request){
        $notif = User::find($request->id)->unreadNotifications;
        return response()->json([
            'unread' =>$notif->count()
        ]);
    }

    //marcar todas las notificaciones como leidas
    public function markAsReadNotifications(Request $request){

        $user = User::find($request->id);
        $notificaciones = $_POST['ids_notif'];

        $count = count($notificaciones);
        for($i=0;$i<$count;$i++) {
            User::find($request->id)->unreadNotifications
                ->where('id', $notificaciones[$i])
                ->markAsRead();
        }


        return response()->json([
            'id' =>$user->id,
            'name' => $user->name,
            'email' => $user->email,
            'telefono'=>$user->telefono,
            'puesto'=>$user->puesto,
            'api_token' =>$user->api_token,
            'url_avatar'=>$user->url_avatar,
            'fcm_token'=>$user->fcm_token
        ]);
    }

    //reporte de material
    public function sendReporte(Request $request){
        $obra = $request->obra;
        $id_materiales = $_POST['id_materiales'];
        $cantidades = $_POST['cantidades'];
        $count = count($id_materiales);
        for($i=0;$i<$count;$i++) {
            MaterialObra::where('id_obra', $obra)
                ->where('mat_obra',$id_materiales[$i])
                ->update(['cantidad'=>$cantidades[$i]]);

            
        }
        return 'reporte actualizado';
    }


    public function qrscan(Request $request ){
        $detalles =
            DetallePedido::where('id_pedido',$request->id)->select('ped_material','cantidad')->get();
        $id_obra = Pedido::where('id',$request->id)->select('pedido.obra')->get();
        $data = json_decode($id_obra);
        $obrita= $data[0]->obra;
        $materiales_obra =
            MaterialObra::where('id_obra',$obrita)->select('materiales_obra.*')->get();

        $arrayDetalles = json_decode($detalles);

        for($i=0; $i<sizeof($arrayDetalles); $i++){
            $id_material = $arrayDetalles[$i]->ped_material;
            $cantidad_material = $arrayDetalles[$i]->cantidad;


            if (MaterialObra::where('mat_obra', '=', $id_material)->
                where('id_obra',$obrita)->exists()) {
                $xcant = MaterialObra::where('id_obra', $obrita)
                    ->where('mat_obra', $id_material)->select('materiales_obra.cantidad')->get();
                $dataX = json_decode($xcant);
                $cant= $dataX[0]->cantidad;

                MaterialObra::where('id_obra', $obrita)
                    ->where('mat_obra', $id_material)
                    ->update(['cantidad' =>(int)$cant+ $cantidad_material]);
            }else {
                $mat = new MaterialObra();
                $mat->cantidad = $cantidad_material;
                $mat->id_obra = $obrita;
                $mat->mat_obra = $id_material;
                $mat->save();
            }
        }
        Pedido::where('id',$request->id)->update(['estado'=>2]);
        return 'envio entregado';
    }


    function disminuir_existencias($id,$cantidad){
        $total = 0;
        $material = App\Material::find($id);
        $total = $material->existencias - $cantidad;
        $material->existencias = $total;
        $material->save();
        if($material->existencias){
            $total = $material->existencias - $cantidad;
            $material->existencias = $total;
            $material->save();
        }
    }



    public function buscar($id_material,$cantidad,$materiales_obra,$id_obra){
        foreach ($materiales_obra as $m){
            if($id_material==$m->mat_obra){
                $actual = $m->catidad;
                $m->cantidad = $cantidad + $actual  ;
                $m->save();
            }else{
                $nuevo  = new MaterialObra();
                $nuevo->cantidad = $cantidad;
                $nuevo->id_obra=$id_obra;
                $nuevo->mat_obra=$id_material;
                $nuevo->save();
            }
        }
        return false;
    }

    /*cancelar solicitud
     *
     * try {
            $result = $client->verify()->cancel('REQUEST_ID');
            var_dump($result->getResponseData());
            }
            catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            }
     *
     * */

    public function sendCode(Request $request){

        $request->validate([
            'apiKey'       => 'required|string',
            'apiSecret'    => 'required|string',
            'number'       => 'required|string',
            'brand'        => 'required|string',
        ]);


        $basic  = new \Nexmo\Client\Credentials\Basic($request->apiKey, $request->apiSecret);
        $client = new \Nexmo\Client($basic);


        $verification = $client->verify()->start([
            'number' => $request->number,
            'brand'  => $request->brand,
            'code_length'  => '4']);

        $request_id = $verification->getRequestId();

        return response()->json([
            'request_id' => $request_id]);
    }


    public function verifyOtp(Request $request){

        $request->validate([
            'apiKey'       => 'required|string',
            'apiSecret'    => 'required|string',
            'request_id'   => 'required|string',
            'code'         =>  'required|string',
        ]);

        $basic  = new \Nexmo\Client\Credentials\Basic($request->apiKey, $request->apiSecret);
        $client = new \Nexmo\Client($basic);

        $codigo = $request->code;
        $request_id = $request->request_id;

        $verification = new \Nexmo\Verify\Verification($request_id);
        $result = $client->verify()->check($verification, $codigo);
        
        //al verificar el codigo registrar | llenar contraseña |

        return response()->json([
            'ok' => 'ok',
            'result' => $result]);
        
    }

    public function mostrar_productos(){
        $productos = Producto::all();
        return response()->json([$productos]);
    }

    public function mostrar_promociones(){
        $promociones = Promocion::all();
        return response()->json(['promociones' => $promociones]);
    }
}