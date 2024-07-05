<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = 'expedientes';
    
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function tratamiento()
    {
        return $this->hasMany(Tratamiento::class, 'tratamiento_id');
    }

    protected $fillable = [
        'tratamiento_id',
        'paciente_id',
        'fecha',
        'seguimiento',
    ];
}
