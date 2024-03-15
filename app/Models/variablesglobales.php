<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variablesglobales extends Model
{
    use HasFactory;

    protected $table='variablesglobales';
    protected $primaryKey = 'id';

    protected $fillable = [       
        'valor'      
    ];

    public $timestamps = false;



}
