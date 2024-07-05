<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $table = 'consulta';

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    
    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'fecha',
        'talla',
        'peso',
        'temperatura',
        'presion',
        'notas',
    ];
}
