<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contacto extends Model
{
    use HasFactory;

    protected $table='contacto';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'comentario',
        'asunto',
        'fecha'
        
    ];

    public $timestamps = false;



}
