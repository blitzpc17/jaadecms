<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use \stdClass;
use Session;
use DB;

use App\Models\contacto;
use App\Models\Utilidades;

class contactocontroller extends Controller
{   

    public function create(Request $r){
        $user = Auth::User();
        return view('Backend.modulos.contacto');
    }  
  

    public function listar(){
        return DB::table('contacto')
        ->select('id', 'nombre','asunto','fecha')
        ->get();

    }

    public function obtener(Request $r){
        return DB::table('contacto')
            ->where('id', $r->id)
            ->select('id', 'nombre', 'correo', 'telefono', 'comentario', 'asunto', 'fecha')           
            ->first();
    }

   
}
