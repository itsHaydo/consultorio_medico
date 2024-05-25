<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Model
{

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre', 
        'apellido_p', 
        'apellido_m', 
        'age', 
        'correo', 
        'telefono', 
        'fecha_nacimiento', 
        'genero_biologico'
    ];
}
