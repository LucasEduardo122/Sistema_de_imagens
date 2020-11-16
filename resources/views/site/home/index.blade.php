@extends('layout')

@section('pagina_titulo', 'Home')
@section('pagina_conteudo')

<main>
    <div class="carousel carousel-slider">
        <a class="carousel-item" href="#one!"><img src="https://images.unsplash.com/photo-1596078425395-59ab95d84d8f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80"></a>
        <a class="carousel-item" href="#two!"><img src="https://images.unsplash.com/photo-1604308307376-67c9ee634dbf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80"></a>
        <a class="carousel-item" href="#three!"><img src="https://images.unsplash.com/photo-1604329051903-d89ddd523330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80"></a>
        <a class="carousel-item" href="#four!"><img src="https://images.unsplash.com/photo-1604004819111-2b09e2ffee95?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"></a>
    </div>
    <div class="container">
        <h1 class="center">Adicione e compartilhe fotos</h1>
    </div>
    <div class="divisao">
        <div class="parallax-container">
            <div class="parallax"><img src="https://images.unsplash.com/photo-1593640495390-1ff7c3f60e9b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=889&q=80"></div>
        </div>
        <div class="section white">
            <div class="row container">
                <h2 class="header">Mantenha-se conectado</h2>
                <p class="grey-text text-darken-3 lighten-3">Salve todas as suas fotos na núvem e as mantenha salvas de serem excluidas acidentalmente</p>
            </div>
        </div>
        <div class="parallax-container">
            <div class="parallax"><img src="https://images.unsplash.com/photo-1581094798398-153528d38b8f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"></div>
        </div>
    </div>
    <script src="{{asset('site/assets/js/jquery.js')}}"></script>
    <script src="{{asset('site/assets/js/materialize.js')}}"></script>
    <script>
        $('.carousel.carousel-slider').carousel({
            fullWidth: true
        });
        $(document).ready(function() {
            $('.parallax').parallax();
        });
        
    </script>
</main>
@stop