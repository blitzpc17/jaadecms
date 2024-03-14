<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use \stdClass;
use Session;
use DB;

use App\Models\slider;
use App\Models\Utilidades;

class sliderController extends Controller
{
    public function create(Request $r){
        $user = Auth::User();
        return view('Backend.modulos.slider');
    }

    public function save(Request $r){
        try{
            $reglas = [                  
                'zona' =>  'required|max:150',              
                'precio' =>  'required',
            ]; 

            $messages = Utilidades::MensajesValidaciones();

            $validador = Validator::make($r->all(), $reglas, $messages);

            if($validador->fails()){
                return response()->json(["status" => 422, 'errors'=>$validador->errors()]);
            }       

         
            $data = array(
                'zona' => $r->zona,               
                'precio' => $r->precio,
               
            );      
            
            $file = $r->file('imagen');
            if($file!=null){
                $fileName = Utilidades::GuardarArchivos('carousels', $file, 'carousel');
                $data["imagen"] =  $fileName;
            }
          
           
            if($r->id==null){                
                slider::create($data);

            }else{             
               
                slider::where('id', $r->id)->update($data);              
            }         

            return response()->json(["status" => 200, "msj"=> "ok", "errors"=>null]);

        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en save", "errors"=>null]);
        }
    } 
    
  

    public function listar(){
        return DB::table('slider')
        ->select('id', 'zona')
        ->get();

    }

    public function obtener(Request $r){
        return DB::table('slider')
            ->where('id', $r->id)
            ->select('id', 'imagen', 'zona', 'precio')           
            ->first();
    }

    public function eliminar(Request $r){
        try{
            DB::table('slider')
            ->where('id', $r->id)
            ->delete();

            return response()->json(["status"=>200, "maj"=> "ok"]);

        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en delete", "errors"=>null]);
        }
        
    }
}
