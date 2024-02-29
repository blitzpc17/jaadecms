<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexController extends Controller
{
    public function home(){
        return view('Frontend.modulos.index');
    }

    public function zonas(){
        return view('Frontend.modulos.zonas');
    }


    public function contacto(){
        return view('Frontend.modulos.contacto');
    }


}
