<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm() {
        if(Auth::check()) {
            return redirect()->route('user.index');
        }

        return view('site.auth.login');
    }

    public function autenticar(Request $request) {

        if(!$this->middleware('VerifyTokenCsrf')){
            $login['status'] = false;
            $login['message'] = "Erro: Ação inválida!";
            echo json_encode($login);
            return;
        }

        if($request->email == "") {
            $login['status'] = false;
            $login['message'] = "Erro: Email inválido!";
            echo json_encode($login);
            return;
        }

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $login['status'] = false;
            $login['message'] = "Erro: Email inválido!";
            echo json_encode($login);
            return;
        }

        if(strlen($request->password) < 6 || $request->password === '') {
            $login['status'] = false;
            $login['message'] = "Erro: A senha deve conter no minimo 6 caracteres!";
            echo json_encode($login);
            return;
        }

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if(Auth::attempt($credentials)){
            $login['status'] = true;
            echo json_encode($login);
            return;
        } else {
            $login['status'] = false;
            $login['message'] = "Erro: Credenciais inválidas!";
            echo json_encode($login);
            return;
        }
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('home');
    }
}
