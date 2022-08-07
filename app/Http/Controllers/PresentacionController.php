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

        $temp_presentacion = Presentacion::where('usuario', auth()->user()->id)
            ->where('invitado', $temp_invitado->id,)
            ->where('socio', $temp_socio->id,)
            ->first();

        if (!empty($temp_presentacion)) {

            $fechaIni = date('Y-m-01');
            $fechaFin  = date("Y-m-t", strtotime($fechaIni));
            $days = (in_array($temp_invitado->ciudad, $this->list_citys)) ? 2 : 60;
            dd($days);


            /***
             * $response = Presentacion::select('*')
             *  ->where('invitado', $temp_invitado->id)
             *  ->where('tipo', "PRESENTACION")
                ->whereBetween('fecha', [$fechaIni, $fechaFin])
                ->get();

                $response = count($response);
             * 
             * 
             * 
             */




            Alert::info($limit[1], 'Restantes de su presentacion');
            return redirect()->back()->withInput();
            #self::funcc(parm1, parm2...);
        }

        DB::beginTransaction();

        try {
            for ($i = 0; $i < $dias; $i++) {
                Presentacion::create([
                    'usuario' => auth()->user()->id,
                    'invitado' => $temp_invitado->id,
                    'socio' => $temp_socio->id,
                    'fecha' => $fecha,
                    'dia' => 1,
                    'tipo' =>  $tipo
                ]);
            }
            DB::commit();
            Alert::success('Presentacion Registrada', 'exito!');
            return back();
        } catch (\Exception $e) {
            Log::info("PresentacionController/registro -> error" . $e->getMessage());
            DB::rollBack();
            toast('Ah ocurrido un problema!', 'error');
            return redirect()->back()->withInput();
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
}
