<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso | Revista Digital</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .main-container {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .login-side { padding: 3rem; }

        .register-side {
            padding: 3rem;
            background-color: #f8f9fa;
            border-left: 1px solid #eee;
        }

        .form-control { border-radius: 8px; padding: 10px 15px; }

        .btn-custom { border-radius: 8px; font-weight: bold; padding: 10px; transition: 0.3s; }
        
        .btn-primary:hover { background-color: #5a67d8; }
        .btn-success:hover { background-color: #38a169; }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center p-3">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 main-container">
                <div class="row">
                    
                    <div class="col-md-6 login-side">
                        <h3 class="fw-bold mb-4 text-primary">Login</h3>

                        @if($errors->has('email') && !old('name')) {{-- Erro apenas se não for tentativa de cadastro --}}
                            <div class="alert alert-danger p-2 small">{{ $errors->first() }}</div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small">E-mail</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="seu@email.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small">Senha</label>
                                <input type="password" name="password" class="form-control" placeholder="********" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btn-custom mb-3">Entrar</button>
                            <a href="/" class="text-muted d-block text-center small text-decoration-none">← Voltar para a Home</a>
                        </form>
                    </div>

                    <div class="col-md-6 register-side">
                        <h3 class="fw-bold mb-4 text-success">Criar Conta</h3>

                        @if($errors->any() && old('name'))
                            <div class="alert alert-danger p-2 small">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('registrar') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small">Nome Completo</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Como quer ser chamado" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">E-mail</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="exemplo@email.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Senha</label>
                                <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100 btn-custom">Cadastrar Gratuitamente</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>