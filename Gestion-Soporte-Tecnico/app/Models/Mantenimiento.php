<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mantenimiento extends Model
{
    protected $table = 'mantenimientos';

    protected $fillable = [
        'tecnico_id',
        'maquina_id',
        'fecha_programada',
        'hora_inicio',
        'hora_fin',
        'duracion',
        'descripcion', 
    ];

    public function tecnico(): BelongsTo
    {
        return $this->belongsTo( Tecnico::class, 'tecnico_id' );
    }

    public function maquina(): BelongsTo
    {
        return $this->belongsTo( Maquina::class, 'maquina_id' );
    }

    public function piezas(): BelongsToMany
    {
        return $this
            ->belongsToMany( Pieza::class, 'detalles_mantenimiento' )
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
