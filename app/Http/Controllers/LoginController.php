<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use Session;
use Redirect;
use DB;

class LoginController extends Controller {

  
    function index() {

        /*  
        //OBTENGO A LAS EMPRESAS Q YA PASARON LOS 30 y 40 DIAS  
       $bloqueo_empresa=DB::select("SELECT empresa.*,DATEDIFF(now(),empresa.fecha)as dias,usuario.id as id_administrador,CONCAT(usuario.nombre,' ',usuario.apellido)as administrador,usuario.token FROM empresa,usuario WHERE usuario.id=empresa.id_administrador AND DATEDIFF(now(),empresa.fecha)>=30 order by dias ASC");
        //$token_30 = array();  
        $token_40 = array();  

        for ($i=0; $i < count($bloqueo_empresa) ; $i++) {
           // if ($bloqueo_empresa[$i]->estado != 2) {
                if ($bloqueo_empresa[$i]->dias < 40) { //CARGO LOS TOKEN Q SON DE 30 DIAS PARA ENIAR NOTIFICACION
                    $token_30 = array();                      
                    array_push($token_30, $bloqueo_empresa[$i]->token); 
                    $dias = 40 - $bloqueo_empresa[$i]->dias;
                    $mensaje = "SU CUENTA SERA BLOQUEADA EN ".$dias." DIAS";
                    $mPushNotification = getPush("ASAPP",$mensaje,null,"","","","","","20");                     
                    send($token_30,$mPushNotification);                     
                } else {//CARGO LOS TOKEN DE LOS Q TIENE 40 O MAS DIAS PARA ENVIAR NOTIFICACION Y BLOQUEARLOS                                           
                    $estado_empresa = DB::table('empresa')->where('id',$bloqueo_empresa[$i]->id)->update(['estado'=>2]);  
                    array_push($token_40, $bloqueo_empresa[$i]->token);                       
                }                
            //}         
        }    */     
        
       /* if (count($token_30) > 0) {
            $mPushNotification = getPush("ASAPP","TIENE Q PAGAR A LOS A ASAPP",null,"","","","","","20");        
            send($token_30,$mPushNotification); 
        } */

        /*if (count($token_40) > 0){
            $mPushNotification = getPush("ASAPP","SU CUENTA FUE BLOQUEADA",null,"","","","","","20");        
            send($token_40,$mPushNotification); 
        }*/
           
        $admin=DB::select("SELECT COUNT(*)contador FROM users"); 
        if ($admin[0]->contador > 0) {
            return view('log.index');                   
        } else {
            return Redirect::to('administrador');
                                     
        }                  
    }
   


    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
      $username= $request['username'];
        $password= $request['password'];
         $sesion=Auth::user();
        if (Auth::attempt(['username' =>$username, 'password' =>$password])) {
             // if(Auth::user()->privilegio==1){
                return Redirect::to('pago_empresa');
             /* }
              else{
                return Redirect::to('empresa');
              }*/
               
//            return response()->json(['messaje',$sesion]);
        }
//        $sesion=Auth::user();
//        Session::flash('message-error', 'Datos Incorrectos');
     Session::flash('message-error', 'DATOS INCORECCTO INTENTE NUEVAMENTE');
        return Redirect::to('/');
//        return response()->json(['messaje', $password]);
//        if($sesion!=null){
//          return response()->json(['messaje','no es null']);  
//        }
// else {return response()->json(['messaje','no es null']); }
//          $email= $request['email'];
//        $password= $request['password'];
//        if (Auth::loginUsingId(1)==false) {
////            return Redirect::to('galpon');
//            return response()->json(['messaje',Auth::loginUsingId(1)]);
//        }
      
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
