@auth
@php
$rotaDestino = match(Auth::user()->permissao) {
3 => 'admin.dashboard',
2 => 'professor.dashboard',
1 => 'profile',
};
@endphp
@endauth

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tittle')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .navbar-brand-techflow {
            font-size: 1.8rem;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-size: 200% auto;

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;

            display: inline-block;
            line-height: 1;
            transition: all 0.5s ease;
        }

        .navbar-brand-techflow:hover {
            scale: 1.1;
            background-position: right center;
            filter: brightness(1.2);
        }

        .nav-link {
            transition: all .2s linear;
        }

        .nav-link:hover {
            scale: 1.1;
            color: #667eea;
        }

        </style>
        @stack('style')

</head>

<body>

    <nav class="navbar navbar-expand-lg border-bottom border-gray-950 border-body shadow bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <span class="navbar-brand-techflow">TechFlow</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-5 mb-lg-1 gap-4 fs-5">
                    @yield('nav_itens')
                </ul>

                @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                @endguest
                @auth
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4 me-2"></i>
                            {{ Auth::user()->name ?? 'Usuário' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route($rotaDestino) }}">Meu Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('amigos') }}">Amigos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>

                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

    @yield('conteudo')
</body>

</html>