<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table = 'tratamientos';
    
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'medicamento_id');
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'cita_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    protected $fillable = [
        'medicamento_id',
        'cita_id',
        'doctor_id',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
    ];
}
