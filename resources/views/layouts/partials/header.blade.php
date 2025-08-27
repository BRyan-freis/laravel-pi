{{-- resources/views/partials/header.blade.php --}}

{{-- Em resources/views/layouts/app.blade.php, dentro do <head> --}}

<style>
    /* |--------------------------------------------------------------------------
    | RESET GERAL E FUNDAÇÃO - CORRIGE A BARRA BRANCA
    |-------------------------------------------------------------------------- */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: #ffffff; /* Cor padrão do fundo */
        color: #2d3748;
    }

    /* O restante das suas variáveis e estilos do modo escuro, se você os adicionou de volta */
    /* ... */


    /* |--------------------------------------------------------------------------
    | Estilos do Header (COM AS CORREÇÕES DE ALINHAMENTO)
    |-------------------------------------------------------------------------- */
    .main-header {
        background: linear-gradient(135deg, #14afa0, #6c57d4);
        padding: 0 40px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    /* 👇 MUDANÇA AQUI: Adicionamos position: relative para servir de âncora */
    .header-interface {
        width: 100%;
        max-width: 1280px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative; 
    }

    .header-logo {
        /* O z-index garante que a logo não fique atrás do menu centralizado */
        position: relative;
        z-index: 2;
    }
    .header-logo a { color: #fff; font-size: 2.4rem; font-weight: 700; text-decoration: none; }
    .header-logo span { background: #59dda0; -webkit-background-clip: text; color: transparent; }

    /* 👇 MUDANÇA AQUI: Posicionamento absoluto para centralização perfeita */
    .main-nav {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 1; /* Fica atrás da logo se houver sobreposição */
    }

    .main-nav ul { 
        list-style: none; 
        display: flex; 
        gap: 40px; 
        align-items: center; 
        margin: 0; 
        padding: 0;
    }
    .main-nav a { color: #ffffff; text-decoration: none; font-weight: bold; font-size: 1.1rem; position: relative; padding-bottom: 5px; }
    .main-nav a:hover { color: #59dda0; }
    .main-nav a::after { content: ''; position: absolute; width: 0; height: 2px; bottom: 0; left: 0; background-color: #59dda0; transition: width 0.3s ease; }
    .main-nav a:hover::after { width: 100%; }
    
    .header-right {
        display: flex;
        align-items: center;
        gap: 25px;
        /* O z-index garante que o menu do usuário não fique atrás do menu centralizado */
        position: relative;
        z-index: 2;
    }
    
    .btn-connect { color: #fff; border: 1px solid #fff; background-color: transparent; padding: 10px 25px; border-radius: 8px; text-decoration: none; font-weight: 600; }
    .user-menu { position: relative; cursor: pointer; }
    .user-avatar { width: 55px; height: 55px; border-radius: 50%; object-fit: cover; border: 2px solid #59dda0; }
    .dropdown-menu { display: none; position: absolute; top: 70px; right: 0; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); width: 220px; overflow: hidden; z-index: 1001; }
    .dropdown-menu.active { display: block; }
    .dropdown-menu a, .dropdown-menu button { display: flex; align-items: center; gap: 10px; width: 100%; text-align: left; padding: 14px 20px; color: #4a5568; text-decoration: none; font-weight: 500; background: none; border: none; font-size: 1.05rem; cursor: pointer; }
    .dropdown-menu a:hover, .dropdown-menu button:hover { background-color: #f0f2f5; }
    .dropdown-menu .logout-form { margin: 0; }
</style>

<header class="main-header">
    <div class="header-interface">
        
        <div class="header-logo">
            <a href="{{ route('home') }}">C<span>o</span>nexus</a>
        </div>

        <nav class="main-nav">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                @auth
                    <li><a href="{{ route('salas.index') }}">Salas</a></li>
                @endauth
                
                <li><a href="{{ route('abordagem') }}">Abordagem</a></li>
                <li><a href="{{ route('salas.index') }}">Agenda</a></li>
                <li><a href="{{ route('sobre') }}">Sobre Nós</a></li>
            </ul>
        </nav>

        <div class="header-right">

            @auth
                <div class="user-menu" id="userMenu">
                    @if(Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="" class="user-avatar">
                    @else
                        <img src="https://i.pinimg.com/736x/11/49/7f/11497f10b3711b1b42a9e327159fc50c.jpg" alt="" class="user-avatar">
                    @endif

                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('perfil.show') }}">Meu Perfil</a>
                        <a href="{{ route('area-user') }}">Area de Usuario</a>
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit">Sair</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-connect">Conectar-se</a>
            @endguest

        </div>
    </div>
</header>

<script>
    // Script simplificado apenas para o menu dropdown
    document.addEventListener('DOMContentLoaded', function() {
        const userMenu = document.getElementById('userMenu');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (userMenu && dropdownMenu) {
            userMenu.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle('active');
            });

            document.addEventListener('click', function(event) {
                if (!userMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('active');
                }
            });
        }
    });
</script>