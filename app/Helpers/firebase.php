<?php 
/*
use App\Moto;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
/**
 * Description of arbol
 *
 * @author GUSTAVO ARANCIBIA CHAIRA
 */

function getPush($title, $message, $image,$cliente,$id_pedido,$nombre,$latitud,$longitud,$tipo){
    $res = array();
    $res['data']['title'] = $title;
    $res['data']['message'] = $message;
    $res['data']['image'] = null;
    $res['data']['cliente'] = "";
    $res['data']['id_pedido'] = "";
    $res['data']['nombre'] = "";
    $res['data']['latitud'] = "";
    $res['data']['longitud'] = "";
    $res['data']['tipo'] = $tipo;    
    $res['data']['pedido'] = "";

    date_default_timezone_set("America/La_Paz") ;
    $fecha =date("d-m-Y",time());
    $hora=date("H:i:s",time());        
    $res['data']['fecha'] = $fecha;
    $res['data']['hora'] = $hora;
    $res['data']['id_empresa'] = "";
    $res['data']['empresa'] = "";
    $res['data']['nombre_direccion'] = "";
    $res['data']['detalle_direccion'] = "";
    $res['data']['monto_total'] = "";
    return $res;        
}

    function send($registration_ids, $message) {
        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
        );
         sendPushNotification($fields);
    }
    
 function sendPushNotification($fields) {

        //firebase server url to send the curl request
        $url = 'https://fcm.googleapis.com/fcm/send';
        $apikey = 'AIzaSyBSNvRMCuZM0l2jnisOTASDqLWPJh9v-rg';
        //building headers for the request
        $headers = array(
            'Authorization: key='.$apikey,
            'Content-Type: application/json'
        );
 
        //Initializing curl to open a connection
        $ch = curl_init();

 
        //Setting the curl url
        curl_setopt($ch, CURLOPT_URL, $url);
        
        //setting the method as post
        curl_setopt($ch, CURLOPT_POST, true);
 
        //adding headers 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);//ESTE AUMENTE

        //disabling ssl support
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        //adding the fields in json format 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        //finally executing the curl request 
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        
        //Now close the connection
        curl_close($ch);
 
        //and return the result 
       // echo var_dump($result);
       // return $result;
       //header("Refresh: 1"); 
    }




//ESTO ES DE TAXICORP
    

/*

     //Para enviar la notificación push necesitamos hacer la solicitud http al servidor firebase. 
    //Curl es una librería de funciones para conectar con servidores
class Firebase {
 
    public function send($registration_ids, $message) {
        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }
    
    
   // Esta función hará que la solicitud curl real al servidor firebase  y luego el mensaje sea enviado 

    private function sendPushNotification($fields) {
         
     
        
        //firebase server url to send the curl request
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        //building headers for the request
        $headers = array(
            'Authorization: key= AIzaSyB68474-5xgM_Ouovnym2S0bf-GQrK1sZU',
            'Content-Type: application/json'
        );
 
        //Initializing curl to open a connection
        $ch = curl_init();

 
        //Setting the curl url
        curl_setopt($ch, CURLOPT_URL, $url);
        
        //setting the method as post
        curl_setopt($ch, CURLOPT_POST, true);
 
        //adding headers 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        //disabling ssl support
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        //adding the fields in json format 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        //finally executing the curl request 
        $result = curl_exec($ch);
        if ($result === FALSE) {
            //die('Curl failed: ' . curl_error($ch));
            
        }
        
        //Now close the connection
        curl_close($ch);
   
        //and return the result 
        return $result;
    }
}*/
