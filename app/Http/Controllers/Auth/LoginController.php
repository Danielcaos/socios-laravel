<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        return $this->sendLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {

        $request->validate([
            'documento' => 'required|integer',
            'contraseña' => 'required',
        ]);
    }

    public function sendLoginResponse(Request $request)
    {

        $errors = null;

        $user = User::where('documento', $request['documento'])->first();


        if (!empty($user)) {
            $errors = 'La contraseña ingresada no es correcta';
            if (Hash::check($request['contraseña'], $user->password)) {
                $this->guard()->login($user);
                return redirect('/home');
            } else {
                return view('auth.login')->with('data', $errors);
            }
        } else {
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        return $this->loggedOut($request) ?: redirect('/');
    }
}
