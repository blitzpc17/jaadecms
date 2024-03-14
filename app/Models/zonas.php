<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class zonas extends Model
{
    use HasFactory;

    protected $table='zonas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'medidas',
        'servicios',
        'precio',
        'coordenadagoogle',
        'miniatura',
        'slider',
        'plano',
        'video',
        'reciente',
        'desde'
    ];

    public $timestamps = false;



    public static function ListarLasted(){
        return DB::table('zonas')
        ->where('reciente',1)
        ->select('id', 'nombre', 'miniatura', 'desde')
        ->get();
    }

    public static function ListarTodas(){

    }










}
