<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ApiController extends Controller
{
    public function getUsers(){
        //return response()->json($consulta=User::select('*')->get());
        $users =User::all();
        return $users;
    }

    public function getUser($id){
        $user = User::find($id);
        return $user;
    }
}