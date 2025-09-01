<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    {{-- Adicione seu CSS aqui --}}
</head>
<body>
    <div>
        <h1>Editar Perfil de Usuário</h1>

        {{-- Bloco para exibir mensagem de sucesso --}}
        @if (session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        {{-- Bloco para exibir erros de validação --}}
        @if ($errors->any())
            <div style="color: red;">
                <strong>Opa! Algo deu errado.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- O atributo enctype é ESSENCIAL para upload de arquivos --}}
        <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div>
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div>
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $user->telefone) }}">
            </div>

            <div>
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" value="{{ old('cidade', $user->cidade) }}">
            </div>

            <hr>
            <p>Deixe os campos de senha em branco para não alterá-la.</p>
            
            <div>
                <label for="password">Nova Senha:</label>
                <input type="password" id="password" name="password">
            </div>

            <div>
                <label for="password_confirmation">Confirmar Nova Senha:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <hr>

            <div>
                <label for="profile_image">Foto de Perfil:</label>
                <input type="file" id="profile_image" name="profile_image">
                @if ($user->profile_image)
                    <p>Imagem atual:</p>
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Foto de Perfil" width="100">
                @endif
            </div>

            <br>
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>