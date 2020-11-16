@extends('layout')

@section('pagina_titulo', 'Login')
@section('pagina_conteudo')
<div class="container">
    <h2>Login</h2>
    <div class="row">
        <form class="col s12" name="formLogin">
            @csrf
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input placeholder="Insira seu email" id="email" type="email" name="email" class="validate">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">https</i>
                <input placeholder="Insira a sua senha" id="password" name="password" type="password" class="validate">
                <label for="password">Senha</label>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="action">Logar
                <i class="material-icons right">vpn_key</i>
            </button>
        </form>
    </div>
</div>
<script src="{{asset('site/assets/js/jquery.js')}}"></script>
<script src="{{asset('site/assets/js/materialize.js')}}"></script>

<script>
    $(function() {
        $('form[name="formLogin"]').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{route('login.do')}}",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(retorno) {
                    if (retorno.status) {
                        window.location.href = "{{route('user.index')}}";
                    } else {
                        var mensagem = retorno.message;
                        M.toast({html: `<span style="color: #e53935"> ${mensagem}`}, 10000, '');
                    }
                }
            });
        });
    });
</script>
@stop