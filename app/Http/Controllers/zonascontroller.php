<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use \stdClass;
use Session;
use DB;

use App\Models\zonas;
use App\Models\Utilidades;

class zonascontroller extends Controller
{
    public function create(Request $r){
        $user = Auth::User();
        return view('Backend.modulos.zonas');
    }

    public function save(Request $r){
        try{
            $reglas = [                               
                'nombre' => 'required|string|max:65',
                'ubicacion' =>  'required|max:350',              
                'medidas' =>  'required|max:35',
                'servicios' =>  'required',
                'precio' =>  'required',               
                'desde' =>  'required'
            ]; 

            $messages = Utilidades::MensajesValidaciones();

            $validador = Validator::make($r->all(), $reglas, $messages);

            if($validador->fails()){
                return response()->json(["status" => 422, 'errors'=>$validador->errors()]);
            }       

         
            $data = array(
                'nombre' => $r->nombre,
                'ubicacion' => $r->ubicacion,               
                'medidas' => $r->medidas,
                'servicios' => $r->servicios,
                'precio' => $r->precio,
                'coordenadagoogle' => $r->coordenadas,              
                'reciente' => ($r->reciente == 1)  ,
                'desde' => $r->desde
            );

            //cargar archivos
            //miniatura
            $file = $r->file('miniatura');
            if($file!=null){
                $fileName = Utilidades::GuardarArchivos('miniaturas', $file, 'miniatura');
                $data["miniatura"] =  $fileName;
            }
           
          
           //'slider'
           $files = $r->file('slider');
           if($files!=null){
            $arrArchivos = [];
            foreach($files as $f){
                $arrArchivos[] = Utilidades::GuardarArchivos('sliders', $f, 'slider');               
            }
            $data["slider"] = implode(',', $arrArchivos);
            
           }
          
           // 'video'
           $file = $r->file('video');
           if($file!=null){
            $fileName = Utilidades::GuardarArchivos('videos', $file, 'video');
            $data["video"] =  $fileName;
           }
          
           // 'plano'
           $file = $r->file('plano');
           if($file!=null){
            $fileName = Utilidades::GuardarArchivos('planos', $file, 'plano');
            $data["plano"] =  $fileName;
           }
           
          
           
            if($r->id==null){                
                zonas::create($data);

            }else{             
               
                zonas::where('id', $r->id)->update($data);              
            }         

            return response()->json(["status" => 200, "msj"=> "ok", "errors"=>null]);

        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en save", "errors"=>null]);
        }
    } 
    
    public function home(Request $r){
        $user = Auth::user();     
        return view('Backend.modulos.zonas', compact('user'));
    }

    public function listar(){
        return DB::table('zonas')
        ->select('id', 'nombre')
        ->get();

    }

    public function obtener(Request $r){
        return DB::table('zonas')
            ->where('id', $r->id)
            ->select('id', 'nombre', 'ubicacion', 'medidas', 'servicios', 'precio', 'coordenadagoogle', 'miniatura', 'slider', 'plano', 'video','reciente', 'desde')           
            ->first();
    }

    public function eliminar(Request $r){
        try{
            DB::table('zonas')
            ->where('id', $r->id)
            ->delete();

            return response()->json(["status"=>200, "maj"=> "ok"]);

        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en delete", "errors"=>null]);
        }
        
    }





}
