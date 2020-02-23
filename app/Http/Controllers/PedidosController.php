<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

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
}
