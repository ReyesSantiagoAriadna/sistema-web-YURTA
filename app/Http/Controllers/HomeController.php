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

         /* $titulo = 'Pedido';
          $tipo=1;
          $mensaje = 'se ha realizado un pedido';
           $link = '/mostrar_pedidos';

/*
            $administradores = User::where('puesto',"=",'gerente')->select('users.*')->get();

           foreach ($administradores as $admin){
                User::find($admin->id)->notify(new TaskCompleted($titulo,$tipo,$mensaje,$link));
            }

       ///     return $administradores;*/

        //   User::find(1)->notify(new TaskCompleted($titulo,$tipo,$mensaje,$link));



        return view('home');
    }

    public static function locale(){
        Carbon::setLocale('es');
    }

    public function notificar(){
        $API_ACCESS_KEY="AIzaSyAUNcqTUttLsiBm9YCs344VbI5Wcil6BZ0";

       /* $fcm_token = 'c7C-ExnJpvA:APA91bGeghal75vdpYohroobE1UzCIORhkyYbp4VFJy6mA0gBK43f-evX6880UXLKyX_F3-_vjNllXCHK5roT9C_udthrGd4zRMsI0N6LvB5OSiqH9IoE_eesnZvHKeZB_w9_pxW473b';
        $id = null;
        $title = 'hola';
        $message = 'papu';

*/
        // prep the bundle
        $registrationIds = ["c7C-ExnJpvA:APA91bGeghal75vdpYohroobE1UzCIORhkyYbp4VFJy6mA0gBK43f-evX6880UXLKyX_F3-_vjNllXCHK5roT9C_udthrGd4zRMsI0N6LvB5OSiqH9IoE_eesnZvHKeZB_w9_pxW473b"];


        // prep the bundle
        $msg = [
            'title'         => 'Programación Android',
            'body'          => 'Prueba 2'
        ];

        $fields = [
            'registration_ids'  => $registrationIds,
            'notification'              => $msg
        ];

        $headers = [
            'Authorization: key= ' . $API_ACCESS_KEY,
            'Content-Type: application/json'
        ];
        $fields = json_encode( $fields );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec($ch );
        curl_close( $ch );

        echo $result;

        return $result;
    }


    function sendPushNotification() {

        $fcm_token = 'ehphesgbZME:APA91bH2veU3wJVAFaeAYjomPnlLkaNkYm8Q7D1fKQaHRYFtY-DIAwaaKaBaO8sRzNkCDJKaLmmJ2ofgtcCuq8Acl2hBUnSW1Wp3CHLPbNpCk7DbNja477Oz1kbSesVnWuybnLHtvGtD';


        $title = 'Hola';
        $message = 'papu';
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
}
