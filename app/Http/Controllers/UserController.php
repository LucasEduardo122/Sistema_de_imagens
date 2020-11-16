<?php

namespace App\Http\Controllers;

use App\Models\Espaco;
use App\Models\espacos_users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user = Espaco::where(['user_id' => Auth::id(), 'status' => 'Ativo'])->get();
        $armazenamento = User::where(['id' => Auth::id()])->get();

        return view('site.user.index', compact('user'), compact('armazenamento'));
    }

    public function upload(Request $request)
    {
        
        if(empty($request->allFiles()['imagem'])) {
            return redirect()->back()->withInput()->withErrors(["Falha no upload"]);
        }

        $user = Espaco::where(['user_id' => Auth::id(), 'status' => 'Ativo'])->get();

        
        for ($c = 0; $c < count($request->allFiles()['imagem']); $c++) {
            $file = $request->allFiles()['imagem'][$c];

            $imagens = new espacos_users();

            $imagens->user_id = Auth::id();
            $imagens->espaco_id = $user[0]->id;
            $imagens->imagem = $file->store('imagens/user/' . Auth::id());
            $imagens->save();
            unset($imagens);
            $this->validacao();
        }
        
        return redirect()->back()->withInput()->withErrors(["Upload concluido"]);
    }

    private function validacao()
    {
        $files = Storage::disk('public')->files('imagens/user/' .  Auth::id());

        if (!empty($files)) {
            for ($c = 0; $c < count($files); $c++) {
                $tamanho = 0;
                $tamanho += Storage::size($files[$c]);
            }
        } else {
            $tamanho = 0;
        }

        $bytes = $tamanho;

        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        $final = $bytes;

        $armazenamento = User::where(['id' => Auth::id()])->get();

        if ($armazenamento[0]->acesso->tamanho_armazenamento === $final) {
            return redirect()->back()->withInput()->withErrors(["Armazenamento cheio. Compre mais espaço!"]);
        }
    }

    public function perfil() {
        $user = User::where(['id' => Auth::id()])->get();

        return view('site.user.perfil', compact('user'));
    }
}
