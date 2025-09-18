@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agenda</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    :root{
      --bg:#f4f7fb;
      --card:#ffffff;
      --muted:#6b7280;
      --accent:#6c5ce7;
      --accent-2:#00b894;
      --danger:#ff7675;
      --slot-border:rgba(15,23,42,0.06);
      --glass:rgba(255,255,255,0.65);
      --shadow: 0 6px 18px rgba(12,20,55,0.06);
      --radius:12px;
      --gutter:16px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      font-family:'Poppins', sans-serif;
      margin:0;
      background:linear-gradient(180deg,var(--bg),#eef2f7);
      color:#0f172a;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      padding:24px;
      display:flex;
      flex-direction:column;
      gap:16px;
      min-height:100vh;
    }

    .linear-gradient{
      background:linear-gradient(90deg, #6c5ce7, #00b894);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
    }

    .brand{
      display:flex;
      gap:12px;
      align-items:center;
    }

    .logo{
      width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#a29bfe);display:grid;place-items:center;color:white;font-weight:700;box-shadow:var(--shadow)
    }

    h1{margin:0;font-size:18px;font-weight: bold;color:black;}
    p.lead{margin:0;color:var(--muted);font-size:14px;margin-left:30px;}

    .controls{display:flex;gap:8px;align-items:center;margin-right:30px;}
    .btn{background:var(--card);border:1px solid var(--slot-border);padding:8px 12px;border-radius:10px;cursor:pointer;box-shadow:var(--shadow);font-weight:600}
    .btn.ghost{background:transparent}

    main{flex:1;display:flex;flex-direction:column;gap:12px}

    /* Calendar container fills available area */
    .calendar-wrap{
      background:var(--card);
      border-radius:var(--radius);
      padding:12px;
      box-shadow:var(--shadow);
      display:flex;flex-direction:column;gap:12px;min-height:520px;width:100%;
    }

    /* Top row: days names */
    .calendar{
      display:grid;
      grid-template-columns:60px repeat(7,1fr);
      gap:0;
      width:100%;
      height:calc(100% - 40px);
    }

    /* Times column */
    .times{
      border-right:1px solid var(--slot-border);
      padding-top:8px;
      background:linear-gradient(180deg, rgba(250,250,252,0.8), rgba(255,255,255,0.6));
    }
    .times .time{height:56px;padding:6px 8px;font-size:12px;color:var(--muted);display:flex;align-items:flex-start}

    /* Day column header */
    .day-header{
      display:flex;align-items:center;justify-content:center;padding:8px;border-bottom:1px solid var(--slot-border);background:var(--glass);font-weight:700;font-size:13px
    }

    /* Grid for each day: use CSS grid with rows representing 12 hours (8:00-20:00) with 56px each */
    .day-column{
      border-right:1px solid var(--slot-border);
      position:relative;
      overflow:auto;
      background:linear-gradient(180deg, rgba(255,255,255,0.6), rgba(250,250,252,0.6));
    }

    .slots{
      display:grid;
      grid-auto-rows:56px;
    }

    .slot{border-bottom:1px solid var(--slot-border);}

    /* Event blocks */
    .event{
      position:absolute;
      left:8px;right:8px;
      padding:8px 10px;border-radius:10px;background:var(--accent);color:white;font-weight:600;box-shadow:0 8px 20px rgba(12,20,55,0.12);
      display:flex;flex-direction:column;gap:6px;font-size:13px;line-height:1.1
    }

    .event.small{font-size:12px;padding:6px}
    .event.chat{background:var(--accent-2);}
    .event.group{background:#0984e3}
    .event.live{background:linear-gradient(90deg,#fd79a8,#00b894)}
    .event.recorded{background:linear-gradient(90deg,#6c5ce7,#00b894)}

    .event .meta{font-size:11px;opacity:0.9}

    /* legend */
    .legend{display:flex;gap:8px;align-items:center}
    .legend-item{display:flex;gap:8px;align-items:center;font-size:13px;color:var(--muted)}
    .swatch{width:14px;height:14px;border-radius:4px}

    /* Responsive tweaks */
    @media (max-width:920px){
      .calendar{grid-template-columns:48px repeat(5,1fr);}
      .day-header{font-size:12px}
    }

    @media (max-width:640px){
      header{flex-direction:column;align-items:flex-start}
      .calendar{grid-template-columns:40px repeat(3,1fr);}
    }

    /* small accessibility improvements */
    .sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
  </style>
</head>
<body>
  <div class="header">
    <div class="brand">
      <div>
        <p class="lead">Calendário semanal com horários de reuniões e chats ao vivo</p>
      </div>
    </div>

    <div class="controls">
      <div class="legend" aria-hidden>
        <div class="legend-item"><span class="swatch" style="background:var(--accent)"></span>Consulta</div>
        <div class="legend-item"><span class="swatch" style="background:var(--accent-2)"></span>Chat ao vivo</div>
        <div class="legend-item"><span class="swatch" style="background:#0984e3"></span>Grupo</div>
      </div>

      <button class="btn" id="prev">◀</button>
      <button class="btn" id="today">Hoje</button>
      <button class="btn" id="next">▶</button>
    </div>
</div>

  <main>
    <section class="calendar-wrap" role="application" aria-label="Agenda semanal">

      <div style="display:grid;grid-template-columns:60px repeat(7,1fr);align-items:stretch;">
        <div></div>
        <div class="day-header">Seg</div>
        <div class="day-header">Ter</div>
        <div class="day-header">Qua</div>
        <div class="day-header">Qui</div>
        <div class="day-header">Sex</div>
        <div class="day-header">Sáb</div>
        <div class="day-header">Dom</div>
      </div>

      <div class="calendar" aria-hidden="false">
        <aside class="times" aria-hidden>
          <div style="height:8px"></div>
          <!-- times from 08:00 to 20:00 -->
          <div class="time">08:00</div>
          <div class="time">09:00</div>
          <div class="time">10:00</div>
          <div class="time">11:00</div>
          <div class="time">12:00</div>
          <div class="time">13:00</div>
          <div class="time">14:00</div>
          <div class="time">15:00</div>
          <div class="time">16:00</div>
          <div class="time">17:00</div>
          <div class="time">18:00</div>
          <div class="time">19:00</div>
          <div class="time">20:00</div>
        </aside>

        <!-- 7 day columns -->
        <div class="day-column" id="day-1">
          <div class="slots" style="height:100%;">
            <!-- 13 slots (08-20) visualized by grid-auto-rows -->
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
          </div>

          <!-- sample events placed with grid-row converted to absolute positions -->
          <div class="event" style="top:56px; height:112px;" aria-label="Consulta com Dra. Paula 09:00 - 11:00">
            <div>Consulta — Dra. Paula</div>
            <div class="meta">09:00 — 11:00 · Privado</div>
          </div>

        </div>

        <div class="day-column" id="day-2">
          <div class="slots">
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
          </div>

          <div class="event chat" style="top:168px;height:56px;" aria-label="Chat ao vivo com facilitador 13:00 - 14:00">
            <div>Chat ao vivo — Facilitador</div>
            <div class="meta">13:00 — 14:00 · Aberto</div>
          </div>

        </div>

        <div class="day-column" id="day-3">
          <div class="slots">
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
          </div>

          <div class="event group" style="top:224px;height:168px;" aria-label="Grupo terapêutico 15:00 - 18:00">
            <div>Grupo terapêutico</div>
            <div class="meta">15:00 — 18:00 · Inscrição necessária</div>
          </div>

        </div>

        <div class="day-column" id="day-4">
          <div class="slots">
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
          </div>

          <div class="event recorded" style="top:56px;height:84px;" aria-label="Sessão gravada disponível 09:00 - 10:30">
            <div>Sessão gravada</div>
            <div class="meta">09:00 — 10:30 · On-demand</div>
          </div>

        </div>

        <div class="day-column" id="day-5">
          <div class="slots">
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
          </div>

          <div class="event" style="top:336px;height:56px;" aria-label="Consulta com Dr. Marcos 14:00 - 15:00">
            <div>Consulta — Dr. Marcos</div>
            <div class="meta">14:00 — 15:00 · Privado</div>
          </div>

        </div>

        <div class="day-column" id="day-6">
          <div class="slots">
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
          </div>

          <div class="event live" style="top:100px;height:100px;" aria-label="Consulta com Dr. Marcos 14:00 - 15:00">
            <div>Live Ansiedade — Dr. Bianca</div>
            <div class="meta">09:30 — 10:00 · Público</div>
          </div>

        </div>

        <div class="day-column" id="day-7">
          <div class="slots">
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
            <div class="slot"></div>
          </div>

        </div>

      </div>

    </section>

  </main>

  <script>
    // Simple client-side controls for demonstration
    (function(){
      const todayBtn = document.getElementById('today');
      todayBtn.addEventListener('click', ()=>{
        // highlight today's column lightly
        document.querySelectorAll('.day-column').forEach((c,i)=>{
          c.style.boxShadow='none';
        });
        const weekday = (new Date()).getDay(); // 0 sunday..6 saturday
        // map so that Monday is index 0 -> day-column id day-1 is Monday
        const map = {1:1,2:2,3:3,4:4,5:5,6:6,0:7};
        const id = 'day-'+map[weekday];
        const el = document.getElementById(id);
        if(el){
          el.style.boxShadow='inset 0 0 0 2px rgba(108,92,231,0.12)';
          el.scrollTop = 56*2; // scroll a bit into the day
        }
      });

      document.getElementById('prev').addEventListener('click', ()=>{
        alert('Navegação de semana: função demo. Integrar ao backend para carregar semanas anteriores.');
      });
      document.getElementById('next').addEventListener('click', ()=>{
        alert('Navegação de semana: função demo. Integrar ao backend para carregar semanas seguintes.');
      });
    })();
  </script>
</body>
</html>
@endsection