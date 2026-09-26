<?php
$year = date('Y');

$modules = [
  ['code'=>'M201','title'=>"Préparation d'un projet web",'domain'=>'Conception, Agile/Scrum','cat'=>'gestion','ex'=>'—','proj'=>'—','updated'=>'À compléter'],
  ['code'=>'M202','title'=>'Approche Agile','domain'=>'Gestion et suivi de projet','cat'=>'gestion','ex'=>'—','proj'=>'—','updated'=>'À compléter'],
  ['code'=>'M203','title'=>'Gestion des données','domain'=>'Bases de données relationnelles et non-relationnelles, SQL/NoSQL','cat'=>'data','ex'=>'—','proj'=>'—','updated'=>'À compléter'],
  ['code'=>'M204','title'=>'Développement Front-end','domain'=>'JavaScript avancé, React.js / Intégration','cat'=>'frontend','ex'=>'—','proj'=>'—','updated'=>'À compléter'],
  ['code'=>'M205','title'=>'Développement Back-end','domain'=>'PHP, Laravel, APIs, Node.js','cat'=>'backend','ex'=>'—','proj'=>'—','updated'=>'À compléter'],
  ['code'=>'M206','title'=>'Création d\'une application Cloud Native','domain'=>'Cloud computing, déploiements','cat'=>'cloud','ex'=>'—','proj'=>'—','updated'=>'À compléter'],
  ['code'=>'M207','title'=>'Projet de synthèse','domain'=>'Projet académique final','cat'=>'synthese','ex'=>'—','proj'=>'—','updated'=>'À compléter'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Oussama Laaziz — Portfolio</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=Noto+Naskh+Arabic:wght@500;600&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#0F172A; --bg-raised:#141E33; --bg-card:#16213A;
  --text:#F1F5F9; --text-dim:#94A3B8; --border:#22304D;
  --emerald:#10B981; --blue:#0EA5E9;
  --amber:#F59E0B; --violet:#8B5CF6; --teal:#14B8A6; --rose:#FB7185;
  box-sizing:border-box;
  padding-top:env(safe-area-inset-top,0px);
  padding-bottom:env(safe-area-inset-bottom,0px);
}
:root[data-theme="light"]{
  --bg:#F8FAFC; --bg-raised:#FFFFFF; --bg-card:#FFFFFF;
  --text:#0F172A; --text-dim:#475569; --border:#E2E8F0;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;scroll-padding-top:76px}
body{
  background:var(--bg); color:var(--text);
  font-family:'Inter',system-ui,-apple-system,sans-serif;
  line-height:1.6; -webkit-font-smoothing:antialiased;
}
h1,h2,h3,.logo,.mono{font-family:'Space Grotesk',system-ui,sans-serif}
.mono{font-variant-numeric:tabular-nums}
a{color:inherit; text-decoration:none}
.wrap{max-width:1100px; margin:0 auto; padding:0 24px}
.overflow-x{overflow-x:auto}

nav{
  position:fixed; top:0; left:0; right:0; z-index:50;
  padding-top:calc(18px + env(safe-area-inset-top,0px)); padding-bottom:18px;
  background:color-mix(in srgb, var(--bg) 88%, transparent);
  backdrop-filter:blur(10px); border-bottom:1px solid var(--border);
}
nav .wrap{display:flex; justify-content:space-between; align-items:center}
.logo{font-size:1.25rem; font-weight:700; letter-spacing:-0.02em}
.logo span{color:var(--emerald)}
.nav-links{display:flex; gap:32px; font-size:0.95rem; color:var(--text-dim)}
.nav-links a:hover{color:var(--text)}
@media (max-width:640px){.nav-links{display:none}}

.hero{padding:180px 0 100px}
.hero .tag{
  display:inline-block; font-size:0.85rem; color:var(--blue);
  border:1px solid var(--border); padding:6px 14px; border-radius:100px; margin-bottom:28px;
}
.hero h1{font-size:clamp(2.6rem,6vw,4.4rem); font-weight:700; letter-spacing:-0.03em; line-height:1.05; max-width:14ch}
.hero .subtitle{font-size:clamp(1.1rem,2.2vw,1.4rem); color:var(--text-dim); margin-top:20px; max-width:44ch; font-weight:500}
.hero p{color:var(--text-dim); max-width:56ch; margin-top:22px; font-size:1.02rem}
.cta-row{display:flex; gap:16px; margin-top:40px; flex-wrap:wrap}
.btn{padding:14px 26px; border-radius:10px; font-weight:600; font-size:0.96rem; transition:transform .18s ease, box-shadow .18s ease; display:inline-block}
.btn-primary{background:var(--emerald); color:#04150F}
.btn-primary:hover{transform:translateY(-2px); box-shadow:0 10px 30px -8px rgba(16,185,129,.55)}
.btn-secondary{border:1px solid var(--border); color:var(--text)}
.btn-secondary:hover{border-color:var(--blue); color:var(--blue)}

.section{padding:90px 0}
.section-head{margin-bottom:40px; max-width:60ch}
.section-head h2{font-size:clamp(1.7rem,3.5vw,2.3rem); font-weight:700; letter-spacing:-0.02em}
.section-head p{color:var(--text-dim); margin-top:12px}

.legend{display:flex; gap:18px; flex-wrap:wrap; margin-bottom:36px; font-size:0.85rem; color:var(--text-dim)}
.legend span{display:inline-flex; align-items:center; gap:7px}
.legend i{width:8px; height:8px; border-radius:50%; display:inline-block}

.modules-grid{display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:20px}
.module-card{
  background:var(--bg-card); border:1px solid var(--border); border-left:3px solid var(--cat-color, var(--emerald));
  border-radius:14px; padding:26px; opacity:0; transform:translateY(14px);
  transition:opacity .5s ease, transform .5s ease, border-color .2s ease;
}
.module-card.in-view{opacity:1; transform:translateY(0)}
.module-card:hover{border-color:var(--cat-color, var(--emerald))}
.module-top{display:flex; align-items:baseline; gap:10px; margin-bottom:6px}
.module-code{font-size:0.85rem; color:var(--cat-color, var(--emerald)); font-weight:600}
.module-title{font-size:1.08rem; font-weight:600}
.module-domain{color:var(--text-dim); font-size:0.9rem; margin-bottom:18px}
.module-block{margin-top:14px; border-top:1px solid var(--border); padding-top:14px}
.module-block h4{font-size:0.82rem; color:var(--text-dim); font-weight:600; margin-bottom:6px}
.module-block p{font-size:0.92rem; color:var(--text)}
.module-updated{margin-top:18px; font-size:0.78rem; color:var(--text-dim); display:flex; align-items:center; gap:6px}
.dot{width:6px; height:6px; border-radius:50%; background:var(--cat-color, var(--blue)); display:inline-block}

.faith{padding:110px 0; text-align:center}
.faith .divider{width:60px; height:2px; background:var(--emerald); margin:0 auto 44px}
.faith .arabic{font-family:'Noto Naskh Arabic',serif; font-size:clamp(1.5rem,3.5vw,2.1rem); line-height:2.1; direction:rtl; max-width:36ch; margin:0 auto; font-weight:600}
.faith .translation{color:var(--text-dim); max-width:48ch; margin:28px auto 0; font-size:0.98rem; line-height:1.8}

footer{border-top:1px solid var(--border); padding:44px 0}
footer .wrap{display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px}
.foot-links{display:flex; gap:22px}
.foot-links a{color:var(--text-dim); font-size:0.92rem}
.foot-links a:hover{color:var(--emerald)}
.copyright{color:var(--text-dim); font-size:0.85rem}

@media (prefers-reduced-motion:reduce){
  html{scroll-behavior:auto}
  .module-card{transition:none; opacity:1; transform:none}
}
</style>
</head>
<body>

<nav>
  <div class="wrap">
    <div class="logo">Oussama<span></div>
    <div class="nav-links">
      <a href="#modules">Modules</a>
      <a href="#foi">À propos</a>
      <a href="#contact">Contact</a>
    </div>
  </div>
</nav>

<section class="hero wrap">
  <div class="tag">ISTA NTIC Tanger — OFPPT</div>
  <h1>Oussama Laaziz</h1>
  <p class="subtitle">Stagiaire de Développement Digital — Option Web Full Stack</p>
  <p>Cet espace retrace ma deuxième année de formation : les modules que j'étudie, les exercices que je pratique, et les projets que je construis semaine après semaine.</p>
  <div class="cta-row">
    <a href="#modules" class="btn btn-primary">Explorer les modules</a>
    <a href="#contact" class="btn btn-secondary">Me contacter</a>
  </div>
</section>

<section class="section wrap" id="modules">
  <div class="section-head">
    <h2>Suivi académique</h2>
    <p>Les sept modules de ma deuxième année, colorés par domaine, avec mes exercices pratiques et projets à mesure qu'ils avancent.</p>
  </div>
  <div class="legend">
    <span><i style="background:var(--amber)"></i>Gestion / Agile</span>
    <span><i style="background:var(--violet)"></i>Données</span>
    <span><i style="background:var(--blue)"></i>Front-end</span>
    <span><i style="background:var(--emerald)"></i>Back-end</span>
    <span><i style="background:var(--teal)"></i>Cloud</span>
    <span><i style="background:var(--rose)"></i>Synthèse</span>
  </div>
  <div class="modules-grid overflow-x">
    <?php
    $catColors = [
      'gestion'  => 'var(--amber)',
      'data'     => 'var(--violet)',
      'frontend' => 'var(--blue)',
      'backend'  => 'var(--emerald)',
      'cloud'    => 'var(--teal)',
      'synthese' => 'var(--rose)',
    ];
    foreach ($modules as $m):
      $color = $catColors[$m['cat']] ?? 'var(--emerald)';
    ?>
    <div class="module-card" style="--cat-color: <?php echo $color; ?>">
      <div class="module-top">
        <span class="module-code mono"><?php echo htmlspecialchars($m['code']); ?></span>
        <span class="module-title"><?php echo htmlspecialchars($m['title']); ?></span>
      </div>
      <div class="module-domain"><?php echo htmlspecialchars($m['domain']); ?></div>
      <div class="module-block">
        <h4>Exercices pratiques</h4>
        <p><?php echo htmlspecialchars($m['ex']); ?></p>
      </div>
      <div class="module-block">
        <h4>Projets récents</h4>
        <p><?php echo htmlspecialchars($m['proj']); ?></p>
      </div>
      <div class="module-updated"><span class="dot"></span>Dernière mise à jour : <?php echo htmlspecialchars($m['updated']); ?></div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="faith wrap" id="foi">
  <div class="divider"></div>
  <p class="arabic">وَقُلِ اعْمَلُوا فَسَيَرَى اللَّهُ عَمَلَكُمْ وَرَسُولُهُ وَالْمُؤْمِنُونَ</p>
  <p class="translation">« Et dis : Œuvrez ! Allah verra votre œuvre, ainsi que Son Messager et les croyants. » — Un rappel à toujours viser l'ihsan (l'excellence), à travailler avec sérieux, et à s'en remettre pleinement à Allah.</p>
</section>

<footer id="contact">
  <div class="wrap">
    <div class="copyright">© <?php echo $year; ?> Oussama Laaziz. Crafted with dedication.</div>
    <div class="foot-links">
      <a href="https://github.com/" target="_blank" rel="noopener">GitHub</a>
      <a href="https://www.linkedin.com/in/oussama-laaziz-8690453a5/" target="_blank" rel="noopener">LinkedIn</a>
    </div>
  </div>
</footer>

<script>
try{
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('in-view'); io.unobserve(e.target); } });
  }, {threshold:0.15});
  document.querySelectorAll('.module-card').forEach(c=>io.observe(c));
}catch(e){
  document.querySelectorAll('.module-card').forEach(c=>c.classList.add('in-view'));
}
</script>
</body>
</html>
