<!DOCTYPE html>
<html lang="pr_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage - @yield('pagina_titulo')</title>
    <link rel="stylesheet" href="{{asset('site/assets/css/materialize.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="teal lighten-2">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" class="brand-logo">Sistema de imagens</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="{{route('home')}}">Home</a></li>
                        @if(!Auth::check())
                        <li><a href="{{route('login.form')}}">Login</a></li>
                        <li><a href="{{route('register.form')}}">Registro</a></li>
                        @endif

                        @if(Auth::check())

                        <!-- Dropdown Trigger -->
                        <li><a class='dropdown-trigger' id="user" href='#' data-target='dropdown1'>@php $user = Auth::User(); echo $user->name @endphp <i class="material-icons right">arrow_drop_down</i></a></li>

                        <!-- Dropdown Structure -->
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="{{route('user.perfil')}}"><i class="material-icons prefix">verified_user</i>Perfil</a></li>
                            <li><a href="{{route('user.index')}}"><i class="material-icons prefix">cloud</i> Espaço</a></li>
                            <li><a href="{{route('login.logout')}}"><i class="material-icons prefix">exit_to_app</i> Sair</a></li>
                        </ul>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @yield('pagina_conteudo')
    <script>
        $('#user').dropdown();
    </script>
</body>

</html>