<?php

namespace App\Http\Controllers;

use Alert;
use DateTime;
use App\Models\Socio;
use App\Models\Invitado;
use App\Models\Presentacion;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class PresentacionController extends Controller
{

    public $list_citys = ["CUCUTA", "VILLA DEL ROSARIO", "PATIOS"];


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_presentacion()
    {
        return view('dashboard.user.presentacion');
    }

    public function registro(Request $request)
    {

        $request->validate([
            'cedula' => 'required|integer',
            'codigo' => 'required',
            'fecha' => 'required',
            'dias' => 'required|integer',
        ]);

        $cedula = $request->input('cedula');
        $codigo = $request->input('codigo');
        $fecha = $request->input('fecha');
        $dias = $request->input('dias');
        $tipo = $request->input('tipo');

        $temp_invitado = Invitado::where('cedula', $cedula)->first();
        $temp_socio = Socio::where('codigo', $codigo)->first();

        if (empty($temp_invitado) || empty($temp_socio)) {
            toast('Cedula Invitado y/o Codigo Socio no existe!', 'error');
            return redirect()->back()->withInput();
        }


        $days = (in_array($temp_invitado->ciudad, $this->list_citys)) ? 2 : 60;

        if ($days == 2) {

            $fechaIni = date('Y-m-01');
            $fechaFin  = date("Y-m-t", strtotime($fechaIni));

            $response = Presentacion::select('*')
                ->where('invitado', $temp_invitado->id)
                ->where('tipo', "PRESENTACION")
                ->whereBetween('fecha', [$fechaIni, $fechaFin])
                ->get();

            $response = count($response);

            if (($response + $dias) > $days) {
                $temop_sum = (($days - $response) == 0) ? "0" : $days - $response;
                Alert::info($temop_sum, 'Dias habiles de presentacion');
                return redirect()->back()->withInput();
            } else {
                DB::beginTransaction();
                $diasv = '1';
                $aux = date("Y-m-d", strtotime("-1 days"));
                $fechaInicio = new DateTime($aux);
                $fechaReal = '';

                try {
                    for ($i = 0; $i < $dias; $i++) {
                        date_add($fechaInicio, date_interval_create_from_date_string($diasv . " days"));
                        $fechaReal  = date_format($fechaInicio, "Y-m-d");
                        Presentacion::create([
                            'usuario' => auth()->user()->id,
                            'invitado' => $temp_invitado->id,
                            'socio' => $temp_socio->id,
                            'fecha' => $fechaReal,
                            'dia' => $diasv,
                            'tipo' =>  $tipo
                        ]);
                    }
                    DB::commit();
                    Alert::success('Presentacion Registrada', 'exito!');
                    return back();
                } catch (\Exception $e) {
                    Log::info("PresentacionController/registro LOCAL -> error" . $e->getMessage());
                    DB::rollBack();
                    toast('Ah ocurrido un problema!', 'error');
                    return redirect()->back()->withInput();
                }
            }
        } else {

            $fechaIni = date('Y-01-01');
            $fechaFin = date('Y-12-31');

            $response = Presentacion::select('*')
                ->where('invitado', $temp_invitado->id)
                ->where('tipo', "PRESENTACION")
                ->whereBetween('fecha', [$fechaIni, $fechaFin])
                ->get();

            $response = count($response);

            if (($response + $dias) > $days) {
                $temop_sum = (($days - $response) == 0) ? "0" : $days - $response;
                Alert::info($temop_sum, 'Dias habiles de presentacion');
                return redirect()->back()->withInput();
            } else {
                DB::beginTransaction();
                $diasv = '1';
                $aux = date("Y-m-d", strtotime("-1 days"));
                $fechaInicio = new DateTime($aux);
                $fechaReal = '';
                try {
                    date("Y-m-d", strtotime($aux . "- 1 days"));
                    for ($i = 0; $i < $dias; $i++) {
                        date_add($fechaInicio, date_interval_create_from_date_string($diasv . " days"));
                        $fechaReal  = (string)date_format($fechaInicio, "Y-m-d");
                        Presentacion::create([
                            'usuario' => auth()->user()->id,
                            'invitado' => $temp_invitado->id,
                            'socio' => $temp_socio->id,
                            'fecha' => $fechaReal,
                            'dia' => $diasv,
                            'tipo' =>  $tipo
                        ]);
                    }
                    DB::commit();
                    Alert::success('Presentacion Registrada', 'exito!');
                    return back();
                } catch (\Exception $e) {
                    Log::info("PresentacionController/registro EXTERNO -> error" . $e->getMessage());
                    DB::rollBack();
                    toast('Ah ocurrido un problema!', 'error');
                    return redirect()->back()->withInput();
                }
            }
        }
    }

    function calc_limit($time, $limit)
    {

        # obtención de fecha límite
        $temp_limit = '+' . $limit . 'day';
        $cal = date("Y-m-d", strtotime($time . $temp_limit));

        # obtención de fecha restante de cierre
        $now = date("Y-m-d");

        # continuación
        $fechaInicio = new DateTime($now);
        $fechaTermino = new DateTime($cal);

        $actual = $fechaInicio->format("Y-m-d");
        $fin = $fechaTermino->format("Y-m-d");


        if ($actual > $fin) {
            return [true, "Se cumplieron los dias vigentes"];
        } else {
            $interval = $fechaTermino->diff($fechaInicio);
            return [false, $interval->format('%d dia(s)')];
        }
    }

    public function restaurante(Request $request)
    {


        $request->validate([
            'cedula_invitado' => 'required|integer',
            'cedula_socio' => 'required',
            'fecha_restaurante' => 'required',
        ]);

        $cedula_invitado = $request->input('cedula_invitado');
        $cedula_socio = $request->input('cedula_socio');
        $fecha_restaurante = $request->input('fecha_restaurante');
        $fecha_restaurante = $request->input('fecha_restaurante');
        $restaurante = $request->input('restaurante');

        $temp_invitado = Invitado::where('cedula', $cedula_invitado)->first();
        $temp_socio = Socio::where('cedula', $cedula_socio)->first();

        if (empty($temp_invitado) || empty($temp_socio)) {
            toast('Cedula Invitado y/o Cedula Socio no existe!', 'error');
            return redirect()->back()->withInput();
        }
        DB::beginTransaction();
        try {

            Presentacion::create([
                'usuario' => auth()->user()->id,
                'invitado' => $temp_invitado->id,
                'socio' => $temp_socio->id,
                'fecha' => $fecha_restaurante,
                'dia' => 0,
                'tipo' =>  $restaurante
            ]);

            DB::commit();
            Alert::success('Restaurante Registrado', 'exito!');
            return back();
        } catch (\Exception $e) {
            Log::info("PresentacionController/restaurante -> error" . $e->getMessage());
            DB::rollBack();
            toast('Ah ocurrido un problema!', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function test(Request $request){
        dd($request->all());
    }


    /*$temp_presentacion = Presentacion::where('usuario', auth()->user()->id)
            ->where('invitado', $temp_invitado->id,)
            ->where('socio', $temp_socio->id,)
            ->first();

         if (!empty($temp_presentacion)) {

            $fechaIni = date('Y-m-01');
            $fechaFin  = date("Y-m-t", strtotime($fechaIni));
            $days = (in_array($temp_invitado->ciudad, $this->list_citys)) ? 2 : 60;
            dd($days);


            
            $response = Presentacion::select('*')
            ->where('invitado', $temp_invitado->id)
            ->where('tipo', "PRESENTACION")
            ->whereBetween('fecha', [$fechaIni, $fechaFin])
            ->get();

            $response = count($response);
            
            if (($response+$dias)>$days) {
                Alert::info($days-$response, 'Dias habiles de presentacion');
            }



            Alert::info($limit[1], 'Restantes de su presentacion');
            return redirect()->back()->withInput();
            #self::funcc(parm1, parm2...);
        } */
}
