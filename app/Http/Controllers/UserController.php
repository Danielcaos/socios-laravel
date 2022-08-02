<?php

namespace App\Http\Controllers;

use App\Models\Invitado;
use Illuminate\Http\Request;
use App\Services\ExcelService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    protected $excelService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->excelService = new ExcelService();
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

    public function index_registro()
    {
        return view('dashboard.user.registro');
    }

    public function index_presentacion()
    {
        return view('dashboard.user.presentacion');
    }

    public function index_ausente()
    {
        return view('dashboard.user.ausente');
    }

    public function index_excel()
    {
        return view('dashboard.user.excel');
    }

    public function registro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cedula' => 'required|max:10',
            'ciudad' => 'required',
            'nombre' => 'required',
            'contacto' => 'required',
        ]);

        $error = $this->send_error($validator);
        if (!empty($error)) return $error;


        $inputs = $request->all();
        return Invitado::register($inputs);

    }

    public function importar(Request $request)
    {
        $request->validate([
            'documento' => 'required|file|mimes:xlsx,csv,xls',
        ]);

        $file = $request->input('documento');

        return $this->excelService->importSocios($file);
    }

    public function send_error($validator)
    {
        if ($validator->fails()) {
            $temp_val = "";
            $temp_errors = "";
            $error = $validator->getMessageBag()->toArray();
            foreach ($error as $key => $value) {
                $temp_errors = implode(",", $value);
                $temp_val .= $temp_errors . "\n";
            }
            return [
                'success' => false,
                'message' =>  $temp_val,
            ];
        }
    }
}
