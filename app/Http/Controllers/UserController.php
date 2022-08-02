<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Http\Models\Socio;
use App\Models\Invitado;

class UserController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $invitados = Invitado::all();
        return view('dashboard.user.index', compact('invitados'));
    }

    public function registro()
    {
        return view('dashboard.user.registro');
    }

    public function presentacion()
    {
        return view('dashboard.user.presentacion');
    }

    public function ausente()
    {
        return view('dashboard.user.ausente');
    }

    public function excel()
    {
        return view('dashboard.user.excel');
    }

    /* public function importar(Request $request)
    {
        if($request->is_file('documento')){
            $path = $request->file('documento')->getRealPath();
            $datos = Excel::load($path, function($reader){
            })->get();

            if(!empty($datos) && $datos->count()){
                $datos->toArray();
                for($i=0; i< count($datos); $i++){
                    $datosImportar[] = $datos[$i];
                }
            }

            Socios::insert($datosImportar);

        }

        return back();

    } */

}
