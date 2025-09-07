<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha - Conexus</title>
    <link rel="stylesheet" href="{{ asset('CSS/styles-recuperacao.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="logo">c<span class="logo-o">o</span>nexus</h1>
            <h2>Recuperar sua senha</h2>
            <p>Insira seu e-mail abaixo. Enviaremos um link para você criar uma nova senha.</p>
            
            @if (session('status'))
                <div class="alert alert-success" style="color: green; margin-bottom: 15px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com" value="{{ old('email') }}" required>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert" style="color: red; font-size: 0.8em;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">Enviar Link de Recuperação</button>
            </form>

            <p class="login-link" style="margin-top: 20px;">
                <a href="{{ route('login') }}">Voltar para o Login</a>
            </p>
        </div>
    </div>
</body>
</html>