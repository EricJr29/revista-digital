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
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

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

        footer {
            font-family: 'Rajdhani', sans-serif;
        }
    </style>
    @stack('style')

</head>

<body>

    <nav class="mb-3 navbar navbar-expand-lg border-bottom border-gray-950 border-body shadow bg-white">
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

    <footer class="bg-dark text-white pt-5 pb-4 mt-5 shadow-lg" style="border-top: 4px solid #6f42c1;">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">

                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <img src="{{ asset('img/logo2.jpg') }}" alt="Logo" class="mb-3 rounded-2" style="width: 120px; object-fit: cover;">
                    <p class="small">Sua plataforma de projetos escolares. Transformando ideias em realidade e conectando alunos e professores.</p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-primary">Navegação</h5>
                    <p><a href="{{ route('home') }}" class="text-white text-decoration-none small">Home</a></p>
                    @auth
                    <p><a href="{{ route('profile') }}" class="text-white text-decoration-none small">Meu Perfil</a></p>
                    <p><a href="{{ route('postagem') }}" class="text-white text-decoration-none small">Novo Projeto</a></p>
                    @endauth
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-primary">Suporte</h5>
                    <p><a href="#" class="text-white text-decoration-none small">FAQ</a></p>
                    <p><a href="#" class="text-white text-decoration-none small">Termos de Uso</a></p>
                    <p><a href="#" class="text-white text-decoration-none small">Privacidade</a></p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-primary">Contato</h5>
                    <p class="small"><i class="bi bi-envelope-fill me-2"></i> ericjroliveira05@gmail.com</p>
                    <div class="mt-4">
                        <a href="https://github.com/EricJr29" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-2"><i class="bi bi-github"></i></a>
                        <a href="https://www.linkedin.com/in/eric-junior-5483b83a0/" target="_blank" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>

            <hr class="mb-4 mt-4">

            <div class="row align-items-center text-white">
                <div class="col-md-7 col-lg-8">
                    <p class="small">© {{ date('Y') }} Todos os direitos reservados porasdasasda:
                        <a href="#" class="text-primary fw-bold text-decoration-none">Eric</a>
                    </p>
                </div>
                <div class="col-md-5 col-lg-4 text-center text-md-end">
                    <span class="badge bg-primary rounded-pill px-3">Versão 1.0</span>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>