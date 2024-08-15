<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaTratamiento extends Model
{
    use HasFactory;

    protected $table = 'consulta_tratamiento';

    protected $fillable = [
        'consulta_id',
        'tratamiento_id',
    ];

    // Relación con el modelo Consulta
    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }

    // Relación con el modelo Tratamiento
    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class);
    }
}
