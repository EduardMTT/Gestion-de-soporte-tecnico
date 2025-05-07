<?php

// app/Models/Maquina.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function mantenimientos(): HasMany
    {
        return $this->hasMany(Mantenimiento::class);
    }
}

