<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use \stdClass;
use Session;
use DB;

use App\Models\servicios;
use App\Models\Utilidades;

class servicioscontroller extends Controller
{
    public function create(Request $r){
        $user = Auth::User();
        return view('Backend.modulos.servicios');
    }

    public function save(Request $r){
        try{
            $reglas = [                               
                'nombre' => 'required|string|max:150',
                'icono' =>  'required|max:150',              
                'descripcion' =>  'required|min:10',
            ]; 

            $messages = Utilidades::MensajesValidaciones();

            $validador = Validator::make($r->all(), $reglas, $messages);

            if($validador->fails()){
                return response()->json(["status" => 422, 'errors'=>$validador->errors()]);
            }       

         
            $data = array(
                'nombre' => $r->nombre,
                'icono' => $r->icono,               
                'descripcion' => $r->descripcion,
               
            );       
          
           
            if($r->id==null){                
                servicios::create($data);

            }else{             
               
                servicios::where('id', $r->id)->update($data);              
            }         

            return response()->json(["status" => 200, "msj"=> "ok", "errors"=>null]);

        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en save", "errors"=>null]);
        }
    } 
    
  

    public function listar(){
        return DB::table('servicios')
        ->select('id', 'nombre')
        ->get();

    }

    public function obtener(Request $r){
        return DB::table('servicios')
            ->where('id', $r->id)
            ->select('id', 'nombre', 'icono', 'descripcion')           
            ->first();
    }

    public function eliminar(Request $r){
        try{
            DB::table('servicios')
            ->where('id', $r->id)
            ->delete();

            return response()->json(["status"=>200, "maj"=> "ok"]);

        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en delete", "errors"=>null]);
        }
        
    }
}
