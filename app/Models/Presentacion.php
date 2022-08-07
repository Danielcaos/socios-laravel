<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    protected $table = 'presentacion';

    protected $fillable = [
        'usuario',
        'invitado',
        'socio',
        'tipo',
        'dia',
        'fecha',
    ];
}
