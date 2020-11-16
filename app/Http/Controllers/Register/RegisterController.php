<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Espaco;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerForm() {
        if(Auth::check()){
            return redirect()->route('user.index');
        }

        return view('site.register.register');
    }

    public function register(Request $request) {
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

        if($request->name == "") {
            $login['status'] = false;
            $login['message'] = "Erro: Preencha o nome!";
            echo json_encode($login);
            return;
        }

        if(strlen($request->password) < 6 || $request->password === '') {
            $login['status'] = false;
            $login['message'] = "Erro: A senha deve conter no minimo 6 caracteres!";
            echo json_encode($login);
            return;
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->nivel_id = '5';

        $user->save();

        $espaco = new Espaco();

        $espaco->user_id = $user->id;
        $espaco->status = 'Ativo';
        $espaco->armazenamento = 'livre';

        $espaco->save();

        $login['status'] = true;
        $login['message'] = "Usuário cadastrado!";
        echo json_encode($login);
        return;
    }
}
