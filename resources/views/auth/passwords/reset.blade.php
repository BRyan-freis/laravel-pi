<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - Conexus</title>
    <link rel="stylesheet" href="{{ asset('CSS/styles-redefinicao.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="logo">C<span class="logo-o">o</span>nexus</h1>
            <h2>Crie sua nova senha</h2>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" placeholder="Digite seu e-mail" required autofocus>
                </div>

                <div class="input-group">
                    <label for="password">Nova senha</label>
                    <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirme sua nova senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme sua senha" required>
                </div>

                <button type="submit" class="submit-btn">Confirmar Alteração</button>
            </form>
            <p class="login-link">Lembrou a senha? <a href="{{ route('login') }}">Faça o Login</a></p>
        </div>
    </div>
</body>
</html>