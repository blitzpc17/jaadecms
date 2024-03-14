<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\zonas;
use App\Models\servicios;
use App\Models\slider;
use Illuminate\Support\Facades\Storage;
use DB;

class indexController extends Controller
{
    public function home(){
        $zonas = zonas::ListarLasted();
        $servicios = servicios::all();
        $sliders = slider::all();
        return view('Frontend.modulos.index',compact('zonas', 'servicios', 'sliders'));
    }

    public function zonas(){
        $zonas = DB::table('zonas')
                    ->get();
        return view('Frontend.modulos.zonas', compact('zonas'));
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
        
        return view('Frontend.modulos.zona', compact('zonas', 'zona', 'titulo', 'sliders', 'video', 'ubicacion', 'plano'));
    }


    public function contacto(){
        return view('Frontend.modulos.contacto');
    }


}
