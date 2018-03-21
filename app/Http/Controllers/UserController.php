<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use Session;
use Redirect;
use DB;
use Hash;

class UserController extends Controller {

   /* public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }*/

    function index() {
        $users = User::paginate(10);
        return view('users.index', compact('users', $users));
    }
    public function create() {            
        return view('users.create');
    }
    public function store(UsersRequest $request) {
        $verificar = DB::select('select count(*) count from users where users.username="' . $request->username . '"');
        if ($verificar[0]->count == 0) {
                DB::table('users')->insert(['username'=>$request['username'], 'nombre'=>$request['nombre'], 'apellido'=>$request['apellido'], 'password'=>Hash::make($request['password'])]);
                Session::flash('message', 'ADMINISTRADOR CREADO CORRECTAMENTE');
                return Redirect::to('/administrador');
        } else {
            Session::flash('message-error', 'YA EXISTE ESE NOMBRE DE ADMINISTRADOR, INTENTE NUEVAMENTE');
            return Redirect::to('/administrador');
        }
    }



    function index_2() {
        $users = User::paginate(10);
        return view('users.index_2', compact('users', $users));
    }

    public function create_2() {            
        return view('users.create_2');
    }

    public function store_2(UsersRequest $request) {
        $verificar = DB::select('select count(*) count from users where users.username="' . $request->username . '"');
        if ($verificar[0]->count == 0) {
                DB::table('users')->insert(['username'=>$request['username'], 'nombre'=>$request['nombre'], 'apellido'=>$request['apellido'], 'password'=>Hash::make($request['password'])]);
                Session::flash('message', 'ADMINISTRADOR CREADO CORRECTAMENTE');
                return Redirect::to('/administradr');
        } else {
            Session::flash('message-error', 'YA EXISTE ESE NOMBRE DE ADMINISTRADOR, INTENTE NUEVAMENTE');
            return Redirect::to('/administradr');
        }
    }



    public function edit($id) {
        $trabajador = User::find($id);
        $empresa = Empresa::where('id', $trabajador->id_empresa)->lists('nombre', 'id');

        return view('usuario.edit', ['user' => $trabajador], compact('empresa'));
    }

    public function update($id, UserUpdateRequest $request) {
        
        $verificar = DB::select('select count(*) count from users where users.email<>"' . $request->email . '" and users.id='.$id);
        if ($verificar[0]->count == 0) {
            if ($request['privilegio'] != 3) {
               try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->fill([
                'name' => $request->name,
                'email' => $request->email,
                'privilegio' => $request->privilegio,
                'estado' => $request->estado,
                'password' => Hash::make($request->password),
                'id_empresa' => $request->id_empresa
            ]);
            $user->save();
            DB::commit();
            Session::flash('message', 'Usuario Actualizado Correctamente');
            return Redirect::to('/usuario');
        } catch (Exception $ex) {
            DB::rollback();
            echo $exc->getTraceAsString();
        }
            } else {//registra a los usuario android con password encriptado en MD5
                try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->fill([
                'name' => $request->name,
                'email' => $request->email,
                'privilegio' => $request->privilegio,
                'estado' => $request->estado,
                'password' => md5($request['password']),
                'id_empresa' => $request->id_empresa
            ]);
            $user->save();
            DB::commit();
            Session::flash('message', 'Usuario Actualizado Correctamente');
            return Redirect::to('/usuario');
        } catch (Exception $ex) {
            DB::rollback();
            echo $exc->getTraceAsString();
        }
            }
        } else {
            Session::flash('message-error', 'Ya existe un usuario con ese nick');
            return Redirect::to('/usuario');
        }
        
        
    }

}
