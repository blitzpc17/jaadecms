<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\zonas;
use App\Models\servicios;
use App\Models\slider;
use App\Models\contacto;
use App\Models\Utilidades;
use Validator;

use Illuminate\Support\Facades\Storage;
use DB;

class indexController extends Controller
{
    public function home(){
        $zonas = zonas::ListarLasted();
        $servicios = servicios::all();
        $sliders = slider::all();

        $telefonos = DB::table('variablesglobales')->where('nombre', 'Telefonos')->first();
        $telefonos = explode(',', $telefonos->valor);

        $whats = DB::table('variablesglobales')->where('nombre', 'TelefonoWhatsApp')->first();
        $whats = $whats->valor;

        $redes =  DB::table('variablesglobales')->where('nombre', 'RedesSociales')->first();
        $redes = json_decode($redes->valor);

        $direccion = DB::table('variablesglobales')->where('nombre', 'Domicilio')->first()->valor;

        $correoContacto = DB::table('variablesglobales')->where('nombre', 'CorreoContacto')->first()->valor;

        $ubicacion = DB::table('variablesglobales')->where('nombre', 'Ubicacion')->first()->valor;

        return view('Frontend.modulos.index',compact('zonas', 'servicios', 'sliders', 'telefonos', 'whats', 'redes', 'direccion', 'correoContacto', 'ubicacion'));
    }

    public function zonas(){
        $zonas = DB::table('zonas')
                    ->get();


                    $telefonos = DB::table('variablesglobales')->where('nombre', 'Telefonos')->first();
                    $telefonos = explode(',', $telefonos->valor);
            
                    $whats = DB::table('variablesglobales')->where('nombre', 'TelefonoWhatsApp')->first();
                    $whats = $whats->valor;
            
                    $redes =  DB::table('variablesglobales')->where('nombre', 'RedesSociales')->first();
                    $redes = json_decode($redes->valor);
            
                    $direccion = DB::table('variablesglobales')->where('nombre', 'Domicilio')->first()->valor;
            
                    $correoContacto = DB::table('variablesglobales')->where('nombre', 'CorreoContacto')->first()->valor;
            
                    $ubicacion = DB::table('variablesglobales')->where('nombre', 'Ubicacion')->first()->valor;



        return view('Frontend.modulos.zonas', compact('zonas', 'telefonos', 'whats', 'redes', 'direccion', 'correoContacto', 'ubicacion'));
    }

    public function zonasinfo(Request $r){
        $zonas = DB::table('zonas')
        ->get();
        $zona = DB::table('zonas')->where('id', $r->lote)->first();
        $titulo = $zona->nombre;
        $sliders = null;
        if($zona->slider!=null){
            $sliders = explode(',', $zona->slider);
        }

        $video = null;
        if($zona->video!=null){
            $video = $zona->video;
        }

        $ubicacion = null;
        if($zona->ubicacion!=null){
            $ubicacion = $zona->coordenadagoogle;
        }

        $plano = null;
        if($zona->plano!=null){
            $plano = $zona->plano;
        }



        $telefonos = DB::table('variablesglobales')->where('nombre', 'Telefonos')->first();
        $telefonos = explode(',', $telefonos->valor);

        $whats = DB::table('variablesglobales')->where('nombre', 'TelefonoWhatsApp')->first();
        $whats = $whats->valor;

        $redes =  DB::table('variablesglobales')->where('nombre', 'RedesSociales')->first();
        $redes = json_decode($redes->valor);

        $direccion = DB::table('variablesglobales')->where('nombre', 'Domicilio')->first()->valor;

        $correoContacto = DB::table('variablesglobales')->where('nombre', 'CorreoContacto')->first()->valor;

        $ubicacion = DB::table('variablesglobales')->where('nombre', 'Ubicacion')->first()->valor;



        
        return view('Frontend.modulos.zona', compact('zonas', 'zona', 'titulo', 'sliders', 'video', 'ubicacion', 'plano', 'telefonos', 'whats', 'redes', 'direccion', 'correoContacto', 'ubicacion'));
    }


    public function contacto(){
        $zonas = DB::table('zonas')
        ->get();


        $telefonos = DB::table('variablesglobales')->where('nombre', 'Telefonos')->first();
        $telefonos = explode(',', $telefonos->valor);

        $whats = DB::table('variablesglobales')->where('nombre', 'TelefonoWhatsApp')->first();
        $whats = $whats->valor;

        $redes =  DB::table('variablesglobales')->where('nombre', 'RedesSociales')->first();
        $redes = json_decode($redes->valor);

        $direccion = DB::table('variablesglobales')->where('nombre', 'Domicilio')->first()->valor;

        $correoContacto = DB::table('variablesglobales')->where('nombre', 'CorreoContacto')->first()->valor;

        $ubicacion = DB::table('variablesglobales')->where('nombre', 'Ubicacion')->first()->valor;



        return view('Frontend.modulos.contacto', compact('zonas', 'telefonos', 'whats', 'redes', 'direccion', 'correoContacto', 'ubicacion'));
    }



    public function saveComentario(Request $r){
        try{
            $reglas = [                               
                'nombre' => 'required',
                'correo' =>  'required',              
                'telefono' =>  'required',
                'asunto' =>  'required',              
                'comentario' =>  'required'           
            ]; 

            $messages = Utilidades::MensajesValidaciones();

            $validador = Validator::make($r->all(), $reglas, $messages);

            if($validador->fails()){
                return response()->json(["status" => 422, 'errors'=>$validador->errors()]);
            }       

         
            $data = array(
                'nombre' => $r->nombre,
                'correo' => $r->correo,               
                'telefono' => $r->telefono,
                'asunto' => $r->asunto,
                'comentario' => $r->comentario,
                'fecha' => date('Y-m-d H:i:s')
               
            );
            
            
            contacto::create($data);         
           
       

            return response()->json(["status" => 200, "msj"=> "Tu comentario ha sido enviado. Nos pondremos en contacto lo más pronto posible.", "errors"=>null]);

        }catch(Exception $ex){
            Log::error('Error en la clase ' . __CLASS__ . ' en la línea ' . __LINE__ . ': ' . $ex->getMessage());
            return response()->json(["status"=>500, "msj" => "error en save", "errors"=>null]);
        }
    } 
    


}
