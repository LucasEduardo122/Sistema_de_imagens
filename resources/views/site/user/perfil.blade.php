@extends('layout')

@section('pagina_titulo', 'Perfil')
@section('pagina_conteudo')


<div class="container">
    <h3 class="center">Meu Perfil <i class="medium material-icons prefix">contact_mail</i></h3>
    <br /> <br />
    <fieldset>
        <div class="row">
            <form class="col s12">
                <div class="row">
                    @foreach($user as $dados)
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_prefix" type="text" class="validate" value="{{$dados->name}}" disabled>
                        <label for="icon_prefix">Nome</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input id="icon_telephone" type="email" class="validate" value="{{$dados->email}}" disabled>
                        <label for="icon_telephone">email</label>
                    </div>
                    @endforeach
                </div>
            </form>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">wb_cloudy</i>
                <input id="icon_tipo" type="text" class="validate"   style="border: none !important;" value="{{$user[0]->acesso->nome_cargo}}" disabled>
                <label for="icon_tipo">Tipo</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">sd_storage</i>
                <input id="icon_armazenamento" type="email" class="validate" style="border: none !important;" value="{{$user[0]->acesso->tamanho_armazenamento}}"  disabled>
                <label for="icon_armazenamento">Armazenamento total da conta</label>
            </div>
        </div>
        <div class="buttons">
            <div class="row center">
                <a class="waves-effect green darken-4 btn">Editar perfil <i class="material-icons right">create</i></a>
                <a class="waves-effect red darken-4 btn">Excluir Conta <i class="material-icons right">clear</i></a>
            </div>
        </div>
    </fieldset>
</div>


<script src="{{asset('site/assets/js/jquery.js')}}"></script>
<script src="{{asset('site/assets/js/materialize.js')}}"></script>
@stop