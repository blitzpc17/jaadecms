<?php

namespace App\Models;



use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Utilidades 
{
    
    public static function MensajesValidaciones(){
        return $msj = array (
            'required' => "El campo :attribute es obligatorio.",
            "string" => "El valor de ser de tipo Texto.",
            "max" => "Máximo :min carácteres.",
            "min" => "Mínimo :min carácteres.",
            "date" => "El valor debe ser de tipo Fecha.",
            "mimes" => "Solo se permiten archivos .pdf, .doc, .docx.",
            "rol.min" => "Seleccione una opción válida.",
            "modulo.min" => "Seleccione una opción válida."
        );
    }

    public static function GuardarArchivos($carpeta, $file, $raiz){
        $fileName =  Str::random(10). '_'.$raiz.'.' . $file->getClientOriginalExtension();
        $file->move(public_path($carpeta), $fileName);

        return $fileName;
    }

}
