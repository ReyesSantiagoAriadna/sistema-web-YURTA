<?php


namespace App\Http\Controllers\Api;


use App\Material;
use App\MaterialObra;
use App\Obra;
use App\Pedido;
use App\TipoObra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function obras(Request $request){
        $id = $request->id;
        $response['obras']= Obra::select('id','descripcion','lat','lng','fech_ini','dependencia','tipo_obra')
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
        select('id','descripcion','unidad','tipo','marca','precio_unitario')
        ->get();
        return $response;
    }

    public function almacen(Request $request){
        $obra = $request->id;
        $result = Material::where('materiales_obra.id_obra',$obra)
            ->join('materiales_obra', 'material.id', '=', 'materiales_obra.mat_obra')
            ->select('material.id','material.descripcion','material.unidad','material.tipo','material.marca','materiales_obra.cantidad')
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
            'api_token' =>Auth::user()->api_token
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

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }
}