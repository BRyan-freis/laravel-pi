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

<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
  --blue: #2277ee;
  --background: #f5f7fb;
  --text-dark: #1e1e1e;
  --text-light: #666;
  --border-radius: 14px;
  --shadow: 0 6px 16px rgba(0,0,0,0.08);
}

* {
  font-family: 'Poppins', sans-serif;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* Seção do Carrossel */
.carousel-section {
  padding: 60px 0;
  background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
}
.carousel-container {
  position: relative;
  max-width: 1400px;
  margin: 0 auto;
  overflow: hidden;
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
}
.carousel-slide {
  display: flex;
  transition: transform 0.6s ease-in-out;
}
.carousel-slide img {
  width: 100%;
  flex-shrink: 0;
  object-fit: cover;
  height: 480px;
}
.carousel-nav {
  position: absolute;
  top: 50%;
  width: 100%;
  display: flex;
  justify-content: space-between;
  padding: 0 20px;
  transform: translateY(-50%);
}
.carousel-nav button {
  background: rgba(255, 255, 255, 0.85);
  border: none;
  color: var(--blue);
  font-size: 1.8rem;
  cursor: pointer;
  border-radius: 50%;
  width: 50px;
  margin: 0 10px;
  height: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: var(--shadow);
  transition: all 0.3s ease;
}
.carousel-nav button:hover {
  background: var(--blue);
  color: #fff;
  transform: scale(1.15);
}

/* Texto */
.home-text {
  max-width: 650px;
  margin: 3rem auto;
  text-align: center;
  padding: 0 1.2rem;
}
.text-h4 {
  font-size: 1.3rem;
  color: var(--blue);
  margin-bottom: 1rem;
  font-weight: 600;
}
.text-h1 {
  font-size: 2.8rem;
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: 0.5rem;
  color: #111;
  letter-spacing: -0.5px;
}

.text-h2 {
  font-size: 3rem;
  font-weight: 800;
  background: linear-gradient(90deg, #2277ee, #0a3fa8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin: 0.5rem 0 1.5rem;
}

.home-text p {
  font-size: 1.1rem;
  color: var(--text-light);
  margin-bottom: 2rem;
  line-height: 1.7;
  font-weight: 400;
}
.homeusuario-btn {
  display: inline-block;
  background: var(--blue);
  color: #fff;
  padding: 14px 32px;
  border-radius: var(--border-radius);
  font-weight: 600;
  font-size: 1.05rem;
  text-decoration: none;
  box-shadow: var(--shadow);
  transition: all 0.3s ease;
}
.homeusuario-btn:hover {
  background: #0a3fa8;
  transform: translateY(-3px);
}

/* Cards */
/* ====== CARDS ====== */
.cards-container {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  justify-content: center;
  padding: 3rem 1rem;
  max-width: 1200px;
  margin: 0 auto;
}

.card {
  background: linear-gradient(135deg, #ffffff, #f9f9f9);
  border-radius: 18px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.08);
  text-align: center;
  padding: 2rem;
  width: 100%;
  max-width: 360px;
  min-width: 280px;
  text-decoration: none;
  color: var(--text-dark);
  transition: all 0.35s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 160px;
  position: relative;
  overflow: hidden;
}

.card:hover {
  transform: translateY(-10px) scale(1.03);
  box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

.card::before {
  content: "";
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(34,119,238,0.1) 0%, transparent 70%);
  transform: rotate(25deg);
  transition: opacity 0.4s ease;
  opacity: 0;
}

.card:hover::before {
  opacity: 1;
}

/* Texto dentro dos cards */
.card p {
  margin: 0;
  font-size: 1.15rem;
  font-weight: 600;
  line-height: 1.5;
  color: #222;
}

/* Paletas mais vivas */
.card:nth-child(1) {
  background: linear-gradient(135deg, #e3f2fd, #cbbbfbff);
}
.card:nth-child(2) {
  background: linear-gradient(135deg, #e3f2fd, #a5f2cc);
}
.card:nth-child(3) {
  background: linear-gradient(135deg, #e3f2fd, #ffe0a3);
}

/* Responsivo */
@media (max-width: 992px) {
  .text-h1 { font-size: 2rem; }
  .text-h2 { font-size: 2.4rem; }
}
@media (max-width: 768px) {
  .home-text { margin: 2rem auto; }
  .cards-container { flex-direction: column; align-items: center; }
  .card { width: 100%; max-width: 90%; }
}
@media (max-width: 480px) {
  .text-h1 { font-size: 1.7rem; }
  .text-h2 { font-size: 2rem; }
  .homeusuario-btn { padding: 12px 24px; font-size: 1rem; }
}
</style>

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

