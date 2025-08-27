@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4; /* Fundo um pouco mais claro */
        margin: 0;
        padding: 0;
    }
    .perfil-container {
        background-color: #fff;
        max-width: 500px; /* Largura mais compacta */
        margin: 50px auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        text-align: center;
    }
    .perfil-foto {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #007bff;
        margin: 0 auto 20px auto;
        display: block;
    }
    .perfil-nome {
        font-size: 1.8em;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .perfil-email {
        color: #555;
        margin-bottom: 25px;
    }
    .perfil-info div {
        margin-bottom: 10px; /* Espaçamento entre os itens de informação */
        font-size: 1.1em;
    }
    .perfil-info strong {
        color: #333;
    }
    .botoes-container {
        margin-top: 30px;
    }
    .button {
        display: inline-block;
        background-color: #007bff;
        margin: 5px;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s ease;
        border: none;
        cursor: pointer;
    }
    .button:hover {
        background-color: #0056b3;
    }
    .button-danger {
        background-color: #dc3545;
    }
    .button-danger:hover {
        background-color: #c82333;
    }
</style>

<div class="perfil-container">

    @if(Auth::user()->profile_image)
        <img class="perfil-foto" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Foto de Perfil">
    @else
        {{-- Uma imagem padrão caso o usuário não tenha enviado nenhuma --}}
        <img class="perfil-foto" src="https://i.pinimg.com/736x/11/49/7f/11497f10b3711b1b42a9e327159fc50c.jpg" alt="Foto de Perfil Padrão">
    @endif

    @auth
        <div class="perfil-nome">{{ Auth::user()->name }}</div>
        <div class="perfil-email">{{ Auth::user()->email }}</div>

        <div class="perfil-info">
            <div><strong>Idade:</strong> 428</div>
            <div><strong>Cidade:</strong> {{ Auth::user()->cidade ?? 'Não informado' }}</div>
            <div><strong>Telefone:</strong> {{ Auth::user()->telefone ?? 'Não informado' }}</div>
            <div><strong>Senha:</strong> ************</div>
        </div>

        <div class="botoes-container">
            <a class="button" href="{{ route('perfil.edit') }}">Editar Perfil</a>
            <a class="button" href="{{ route('cadastrolaudo') }}">Cadastrar Laudo</a>
            <a class="button" href="{{ route('home') }}">Ver Laudos</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="button button-danger">Desconectar</button>
            </form>
        </div>
    @endauth
</div>
@endsection