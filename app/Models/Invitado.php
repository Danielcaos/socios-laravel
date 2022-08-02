<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
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

    public static function register($request)
    {
        
        $temp_invitado = Invitado::where('cedula', $request["cedula"])->get()->first();

        if (empty($temp_invitado)) {

            try {
                Invitado::create([
                    "cedula" => $request["cedula"],
                    "nombre" => $request["nombre"],
                    "celular" => $request["contacto"],
                    "ciudad" => $request["ciudad"],
                ]);

                return [
                    'response' => true,
                    'message' =>  'Socio agregado.'
                ];

            } catch (\Exception $e) {
                Log::error(" Model/Invitado->register " . " " . $e->getMessage());
                return [
                    'response' => false,
                    'message' =>  'Ah ocurrido un error.'
                ];
            }
        }

        return [
            'response' => false,
            'message' =>  'El numero de cedula ya esta registrado.'
        ];
    }
}
