<?php

namespace App\Http\Controllers;

use App\Models\Invitado;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        if (auth()->user()->hasRole('admin')) {
            return view('dashboard.admin.index', compact('usuarios'));
        } else 
        if (auth()->user()->hasRole('user')) {
            $invitados = Invitado::all();
            return view('dashboard.user.index', compact('invitados'));
        }else{
            dd("no tiene permisos");
        }
    }
}
