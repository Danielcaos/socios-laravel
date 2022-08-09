<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ausente extends Model
{
    protected $table = 'ingreso_ausente';

    protected $fillable = [
        'cedula',
        'dias',
        'fecha',
        'usuario',
    ];
}