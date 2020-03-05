<?php

namespace App\Http\Controllers;

use App\Notifications\TaskCompleted;
use App\Obra;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

          $titulo = 'Pedido';
          $tipo=1;
          $mensaje = 'se ha realizado un pedido';
           $link = '/mostrar_pedidos';


            $administradores = User::where('puesto',"=",'gerente')->select('users.*')->get();

           foreach ($administradores as $admin){
                User::find($admin->id)->notify(new TaskCompleted($titulo,$tipo,$mensaje,$link));
            }

       ///     return $administradores;
        return view('home');
    }

    public static function locale(){
        Carbon::setLocale('es');
    }
}
