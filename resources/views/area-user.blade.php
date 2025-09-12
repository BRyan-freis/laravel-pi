@extends('layouts.app')

@section ('content')

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('CSS/styles-area.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Conexus</title>
</head>

<body>
  <main>
    <section class="home">
      
      <!-- TOPO: CARROSSEL + TEXTO -->
      <div class="home-top">
        
        <!-- Seção do Carrossel de Imagens -->
      <section class="carousel-section">
          <div class="carousel-container">
              <div class="carousel-slide">
                  <img src="{{ asset('SRC/Gemini_Generated_Image_rrxvi9rrxvi9rrxv (1).png') }}" alt="Pessoas conversando em um ambiente acolhedor">
                  <img src="{{ asset('SRC/Gemini_Generated_Image_rrxvi9rrxvi9rrxv (2).png') }}" alt="Grupo de amigos se apoiando">
                  <img src="{{ asset('SRC/Gemini_Generated_Image_gl5aojgl5aojgl5a (1).png') }}" alt="Pessoa recebendo ajuda profissional online">
              </div>
              <div class="carousel-nav">
                  <button id="prevBtn">&#10094;</button>
                  <button id="nextBtn">&#10095;</button>
              </div>
          </div>
      </section>

        <!-- TEXTO AO LADO -->
        <div class="home-text">
          <h4 class="text-h4"><strong>Você está na Conexus</strong></h4>
          <h1 class="text-h1">
  Aqui é o seu lugar para se
</h1>
<h2 class="text-h2">
  <strong>“Conectar”</strong>
</h2>
          <p>
            <strong>
              Escolha uma sala com o tema de seu interesse e participe de reuniões de apoio, conselhos 
              e onde você se sentirá acolhido e abraçado por pessoas que te entendem e enfrentam os mesmos desafios, 
              com um ajudando o outro, a cada passo e a cada nova vitória; Esse é o nosso objetivo, criar conexões, 
              gerando esperança e lembrando a cada pessoa que, mesmo nos dias mais difíceis, ninguém precisa caminhar sozinho.
            </strong>
          </p>
          <a href="salas.html" class="homeusuario-btn">Escolha uma sala</a>
        </div>
      </div>

      <!-- CARDS COMO BOTÕES -->
      <div class="cards-container">
        <a href="pagina1.html" class="card">
          <p><strong>Conheça cada um dos temas que são abordados nas salas de bate-papo</strong></p>
        </a>
        <a href="pagina2.html" class="card">
          <p><strong>Nosso objetivo e política da Conexus</strong></p>
        </a>
        <a href="pagina3.html" class="card">
          <p><strong>Agende uma consulta particular com um profissional com valores exclusivos para usuários da Conexus</strong></p>
        </a>
      </div>
    </section>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lógica do Carrossel
        const slide = document.querySelector('.carousel-slide');
        if (slide) {
            const images = document.querySelectorAll('.carousel-slide img');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            let counter = 0;
            let size = images.length > 0 ? images[0].clientWidth : 0;

            function updateSlidePosition() {
                if (size > 0) {
                    slide.style.transform = 'translateX(' + (-size * counter) + 'px)';
                }
            }
            
            function nextSlide() {
                if (images.length === 0) return;
                if (counter >= images.length - 1) {
                    counter = 0;
                } else {
                    counter++;
                }
                updateSlidePosition();
            }

            nextBtn.addEventListener('click', nextSlide);

            prevBtn.addEventListener('click', () => {
                if (images.length === 0) return;
                if (counter <= 0) {
                    counter = images.length - 1;
                } else {
                    counter--;
                }
                updateSlidePosition();
            });
            
            setInterval(nextSlide, 5000);

            window.addEventListener('resize', () => {
                if (images.length > 0) {
                    size = images[0].clientWidth;
                    updateSlidePosition();
                }
            });
        }
    });
</script>
</body>
</html>

@endsection ('content')

