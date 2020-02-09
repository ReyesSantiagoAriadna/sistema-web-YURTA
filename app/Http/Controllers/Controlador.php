<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Usuario;

class Controlador extends Controller
{
    public function listarUsuarios(){
        $lugares = Usuario::paginate(10);
        return view('Lista_Lugares')->with('var',$lugares)->with('cont',1);
    }
}