<?php


namespace App\Http\Controllers;


class NotificacionController extends Controller
{
    public function __construct(){

    }

    public static function sendPushNotification($fcm_token,$title,$message) {
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