<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    protected $table = 'maquinas';
    protected $fillable = [
        'propietario',
        'marca',
        'modelo',
        'descripcion',
        'fecha_de_adquisicion',
    ];
}
