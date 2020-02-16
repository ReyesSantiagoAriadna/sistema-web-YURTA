<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PedidosController extends Controller
{ 
    public function mostrar(){ 
        $pedidos = App\Pedido::all();
        return view('pedidos.mostrar', compact('pedidos'));
    }

    public function agregar(){ 
        return view('pedidos.agregar');
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
        $pedido = App\Pedido::findOrFail($id);
        return view('pedidos.editar', compact('pedido'));
    }

    public function update(Request $request, $id){
        $pedidoActualizado = App\Pedido::find($id);
        $pedidoActualizado->fecha_p = $request->fecha_p;
        $pedidoActualizado->fecha_conf = $request->fecha_conf;
        $pedidoActualizado->estado = $request->estado;
        $pedidoActualizado->obra = $request->obra;
        $pedidoActualizado->save();
        return back()->with('mensaje','Pedido actualizado');
    }

    public function eliminar($id){
        $pedidoEliminar = App\Pedido::findOrFail($id);
        $pedidoEliminar->delete();
        return back()->with('mensaje','Pedido eliminado');
    }
}
