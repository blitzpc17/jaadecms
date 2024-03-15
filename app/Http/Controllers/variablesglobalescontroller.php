<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use \stdClass;
use Session;
use DB;

use App\Models\variablesglobales;
use App\Models\Utilidades;

class variablesglobalescontroller extends Controller
{
    public function create(Request $r){
        $user = Auth::User();
        return view('Backend.modulos.variables');
    }

    public function save(Request $r){
        try{
            /*$reglas = [                               
                'redes' => 'required',
                'telefonos' =>  'required',              
                'ubicacion' =>  'required',
                'domicilio' => 'required',
                'correo' => 'required',
                'whats' => 'required'
            ]; 

            $messages = Utilidades::MensajesValidaciones();

            $validador = Validator::make($r->all(), $reglas, $messages);

            if($validador->fails()){
                return response()->json(["status" => 422, 'errors'=>$validador->errors()]);
            }  */     


            if($r->redes!=null){
                variablesglobales::where('nombre', 'RedesSociales')->update(["valor"=>$r->redes]);
            }

            if($r->telefonos!=null){
                variablesglobales::where('nombre', 'Telefonos')->update(["valor"=>$r->telefonos]);
            }

            if($r->ubicacion!=null){
                variablesglobales::where('nombre', 'Ubicacion')->update(["valor"=>$r->ubicacion]);
            }

            if($r->domicilio!=null){
                variablesglobales::where('nombre', 'Domicilio')->update(["valor"=>$r->domicilio]);
            }

            if($r->correo!=null){
                variablesglobales::where('nombre', 'CorreoContacto')->update(["valor"=>$r->correo]);
            }

            if($r->whats!=null){
                variablesglobales::where('nombre', 'TelefonoWhatsApp')->update(["valor"=>$r->whats]);
            }
           

            return response()->json(["status" => 200, "msj"=> "ok", "errors"=>null]);

        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en save", "errors"=>null]);
        }
    } 
    
  

    public function obtener(Request $r){
       
        $redes =   variablesglobales::where('nombre', 'RedesSociales')->first();
        $telefonos =   variablesglobales::where('nombre', 'Telefonos')->first();
        $ubicacion =   variablesglobales::where('nombre', 'Ubicacion')->first();
        $domicilio =   variablesglobales::where('nombre', 'Domicilio')->first();
        $correoContacto =   variablesglobales::where('nombre', 'CorreoContacto')->first();
        $telefonoWhats =   variablesglobales::where('nombre', 'TelefonoWhatsApp')->first();

        return response()->json(["redes"=>$redes, "telefonos"=>$telefonos, "ubicacion" => $ubicacion, "domicilio"=>$domicilio, "correoContacto"=>$correoContacto, "telefonoWhats"=>$telefonoWhats]);

    }

   
}
