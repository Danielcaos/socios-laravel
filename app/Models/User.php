<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'documento',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function register($request)
    {
        
        $temp_usuario = User::where('documento', $request["cedula"])->get()->first();

        if (empty($temp_invitado)) {

            try {
                $user = User::create([
                    "documento" => $request["cedula"],
                    "name" => $request["nombre"],
                    "email" => $request["email"],
                    "password" => Hash::make($request["contraseña"]),
                ]);

                $user->assignRole('user');

                return [
                    'response' => true,
                    'message' =>  'Usuario agregado.'
                ];

            } catch (\Exception $e) {
                Log::error(" Model/User->register " . " " . $e->getMessage());
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
