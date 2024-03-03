<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use \stdClass;
use Session;
use DB;

use App\Models\User;
use App\Models\Utilidades;

class UsuariosController extends Controller
{
    public function authenticate(Request $r){

        try{
            $reglas = [             
                'usuario' => 'required|string|min:3',
                'password' => 'required|string|min:8'               
            ];

            $msjval = Utilidades::MensajesValidaciones();

            $validador = Validator::make($r->all(), $reglas, $msjval);

            if($validador->fails()){
                return back()->withErrors($validador)->withInput();
            }

            if(Auth::attempt(['name' => $r->usuario, 'password' => $r->password])){

                $r->session()->regenerate(); 
              
                return redirect()->intended('admin/home');
               
            }           

            return back()->withErrors([
                'unauthorizate' => 'Los datos ingresados no coinciden con nuestros registros.',
            ])->onlyInput('name');


        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en save"]);
        }

    }

    public function logauth(Request $r){        
        Auth::logout();
        Session::flush();
        return redirect()->route('admin.login');
    }

    public function create(Request $r){
        //$user = Auth::User();
        return view('Backend.modulos.usuarios');
    }

    public function save(Request $r){
        try{
            $reglas = [               
                //user
                'username' => 'required|string|max:255',
                'email' => 'required|email|max:255',               
                'password' => 'required|min:8'
            ]; 

            $messages = Utilidades::MensajesValidaciones();

            $validador = Validator::make($r->all(), $reglas, $messages);

            if($validador->fails()){
                return response()->json(["status" => 422, 'errors'=>$validador->errors()]);
            }       

         
            $dataUser = array(
                "name" => $r->username,
                "email" => $r->email,                
            );

            if($r->id==null){                
                $dataUser["password"] = bcrypt($r->password);
                User::create($dataUser);

            }else{               
                if(!empty($r->password)){
                    $dataUser["password"] = bcrypt($r->password);
                }
                User::where('id', $r->id)->update($dataUser);              
            }         

            return response()->json(["status" => 200, "msj"=> "ok"]);

        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en save"]);
        }
    } 
    
    public function home(Request $r){
        $user = Auth::user(); 
        return view('Backend.modulos.home', compact('user'));
    }

    public function listar(){
        return DB::table('users')
        ->select('id', 'name')
        ->get();

    }

    public function obtener(Request $r){
        return DB::table('users')
            ->where('id', $r->id)
            ->first();
    }

}
