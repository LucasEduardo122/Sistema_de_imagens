@extends('layout')

@section('pagina_titulo', 'Espaco')
@section('pagina_conteudo')
@if($errors->all())
@foreach($errors as $error)
<div class="card-panel teal lighten-2"> {{$error}}</div>
@endforeach
@endif
<div class="container">
    <h5 class="center">Espaço livre</h5>
    <div class="row">
        @php
        $id = Auth::id();
        $files = Storage::disk('public')->files('imagens/user/' .$id);

        if(!empty($files)){
        for($c = 0; $c < count($files); $c++){ $tamanho=0; $tamanho +=Storage::size($files[$c]); } } else { $tamanho=0; } $bytes=$tamanho; if ($bytes>= 1073741824)
            {
            $novo_valor = (int )$bytes;
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
            $numero = number_format($novo_valor / 1073741824, 2);
            }
            elseif ($bytes >= 1048576)
            {
            $novo_valor = (int )$bytes;
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
            $numero = number_format($novo_valor / 1048576, 2);
            }
            elseif ($bytes >= 1024)
            {
            $novo_valor = (int )$bytes;
            $bytes = number_format($bytes / 1024, 2) . ' KB';
            $numero = number_format($novo_valor / 1024, 2);
            }
            elseif ($bytes > 1)
            {
            $novo_valor = (int )$bytes;
            $bytes = $bytes . ' bytes';
            $numero = $novo_valor;
            }
            elseif ($bytes == 1)
            {
            $novo_valor = (int) $bytes;
            $bytes = $bytes . ' byte';
            $numero = $novo_valor;
            }
            else
            {
            $bytes = '0 bytes';
            $numero = 0;
            }

            $final = $bytes;
            $finally = str_replace('.',',', $numero);

            $fixo = $armazenamento[0]->acesso->tamanho_armazenamento;

            $fixo2 = intval($fixo) * 4000;
            $porcentagem = (intval($finally) * 100) / $fixo2;

            @endphp
            <h5> {{$final}} / {{$armazenamento[0]->acesso->tamanho_armazenamento}}</h5>
            <div class="progress">¨
                <div class="determinate" <?php echo "style='width: $porcentagem%'"; ?>></div>
            </div>
    </div>
</div>

<div class="container">
    <form name="formImagens" action="{{route('user.upload')}}" method="post" id="form" enctype="multipart/form-data">
        @csrf
        <div class="file-field input-field">
            <div class="btn">
                <span><i class="material-icons">backup</i> Upload</span>
                <input id="arquivo" type="file" name="imagem[]" multiple>
            </div>
            <div class="file-path-wrapper center">
                <div class="row">
                    <div class="col s9">
                        <input class="file-path validate" type="text" placeholder="Upload de imagem">
                    </div>
                    <div class="col s3">
                        <button class="waves-effect waves-light btn" type="submit">Enviar <i class="material-icons left">send</i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="container">
    <h4 class="center">Minhas Imagens</h4>
    <div class="row">
        @forelse($user as $espaco)
        <?php
        if (empty($user[0]->espacos_users[0]->id)) {
        ?>
            <br /><br />
            <div class="container center">
                <div class="lime">
                    <p class="center dark-text">Nenhum arquivo encontrado</p>
                </div>
            </div>
        <?php
        }
        ?>
        @foreach($user[0]->espacos_users as $espacos_users)
        <div class="col s12 m4 18">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator responsive-img z-depth-3" style="height: 300px" src="{{env('APP_URL')}}storage/{{$espacos_users->imagem}}" alt="">
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span><br /><br />
                    <div class="collection">
                        <a href="{{env('APP_URL')}}storage/{{$espacos_users->imagem}}" class="collection-item" download><i class="material-icons left">cloud_download</i> Baixar Foto</a>
                        <a href="#!" class="collection-item"><i class="material-icons left">collections</i>Duplicar Foto (off)</a>
                        <a href="#compartilharFoto" class="collection-item modal-trigger" data-url="{{env('APP_URL')}}storage/{{$espacos_users->imagem}}"><i class="material-icons left">share</i>Compartilhar Foto</a>
                        <a href="#apagarFoto" class="collection-item modal-trigger"><i class="material-icons left">delete</i>Apagar Foto</a>
                    </div>

                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>
@empty

@endforelse

<div id="apagarFoto" class="modal">
    <div class="modal-content">
        <h4>Apagar Foto</h4>
        <p>Deseja mesmo apagar essa foto?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat white-text red darken-1">Não</a>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat white-text green darken-1">Sim</a>
    </div>
</div>

<div id="compartilharFoto" class="modal">
    <div class="modal-content">
        <h4>Compartilhar Foto</h4>
        <br /><br />
        <div class="container">
            <div class="row">
                <div class="input-field col s12">
                    <input id="input_text" type="text" class="url" name="copy" data-length="10"><br /><br /><a href="#!" id="copy" class="waves-effect waves-green btn-flat tooltipped" data-position="right" data-tooltip="Copiado para a area de transferencia"><i class="material-icons left">content_copy</i>Copiar</a>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat white-text green darken-1">Fechar</a>
    </div>
</div>

<script src="{{asset('site/assets/js/jquery.js')}}"></script>
<script src="{{asset('site/assets/js/materialize.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.tooltipped').tooltip();
    });

    $('.modal-trigger').on('click', function() {
        var url = $(this).data('url');
        $('input.url').attr('value', url);
        $('.modal').modal();
    });
</script>
<script>
    document.querySelector("a#copy").addEventListener('mouseover', function() {
        var input = document.querySelector('input.url');

        input.select();

        document.execCommand('copy');
    });
</script>

@stop