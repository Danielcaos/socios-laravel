<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{

    protected $table = 'invitado';

    protected $fillable = [
        'cedula',
        'nombre',
        'ciudad',
        'celular'
    ];

}