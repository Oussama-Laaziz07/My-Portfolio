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

// ---------------------------------------------------------
// ORGANISATION DES ATELIERS
// ---------------------------------------------------------
// Ajoutez simplement les noms de vos sous-dossiers ici. 
// Laissez vide `[]` si vous n'avez pas de sous-dossiers.
$ateliers = [
  1 => ['Dossier 2', 'Dossier 3 (AdvancedEventSolution)', 'Dossier 3 (DKM)', 'En groupe'],
  2 => ['Partie 1'], // <-- Modifiez/Ajoutez les dossiers pour Atelier 2 ici
  3 => ['Partie 2']                          // <-- Vide = cherche directement dans "images/ateliers/Atelier 3"
];
// ---------------------------------------------------------

$atelierColors = ['var(--amber)', 'var(--violet)', 'var(--blue)', 'var(--emerald)', 'var(--teal)', 'var(--rose)'];

function slugify($s) {
  return strtolower(str_replace([' ', '(', ')'], ['-', '', ''], $s));
}

// Scans folder on disk from project root and outputs valid public URLs
function gallery_button($label,$relativeFolder, $id,$color = 'var(--emerald)') {
  $cleanPath = ltrim($relativeFolder, '/');
  
  // Resolve base directory whether script runs inside /api/ or root
  $projectRoot = (basename(__DIR__) === 'api') ? dirname(__DIR__) : __DIR__;
  
  // Try finding path directly or inside public/ folder
  $diskPath = $projectRoot . '/' .$cleanPath;
  if (!is_dir($diskPath)) {$diskPath = $projectRoot . '/public/' .$cleanPath;
  }

  $imgs = [];
  if (is_dir($diskPath)) {
    $files = glob($diskPath . '/*');
    if ($files) {$validExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
      foreach ($files as$f) {
        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
        if (in_array($ext,$validExts)) {
          $imgs[] =$f;
        }
      }
    }
  }

  natsort($imgs);
  ob_start(); ?>
  <button type="button" class="gallery-toggle" data-title="<?php echo htmlspecialchars($label); ?>" aria-controls="<?php echo $id; ?>" style="--cat-color:<?php echo $color; ?>">
    <?php echo htmlspecialchars($label); ?> (<?php echo count($imgs); ?>)
  </button>
  <div class="gallery" id="<?php echo $id; ?>" hidden>
    <?php if ($imgs): foreach ($imgs as$img): 
      // Form clean web path for browser (<img src="/images/...">)
      $webPath = preg_replace('#^public/#', '', $cleanPath);$src = htmlspecialchars('/' . $webPath . '/' . basename($img)); 
    ?>
      <button type="button" class="thumb" data-full="<?php echo $src; ?>"><img src="<?php echo $src; ?>" loading="lazy" alt="<?php echo htmlspecialchars($label); ?>"></button>
    <?php endforeach; else: ?>
      <p class="gallery-empty">Aucune image. Ajoute-les dans <code><?php echo htmlspecialchars($relativeFolder); ?>/</code></p>
    <?php endif; ?>
  </div>
  <?php
  return ob_get_clean();
}
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

.gallery-toggle{
  font:inherit; font-size:0.88rem; font-weight:600; cursor:pointer;
  color:var(--cat-color); background:transparent;
  border:1px solid var(--cat-color); border-radius:8px; padding:8px 14px;
  transition:background .18s ease, color .18s ease;
}
.gallery-toggle:hover,.gallery-toggle[aria-expanded="true"]{background:var(--cat-color); color:#0F172A}
.gallery{display:none}
.gmodal{position:fixed; inset:0; z-index:90; background:var(--bg); overflow-y:auto; padding:0 24px 40px}
.gmodal[hidden]{display:none}
.gmodal-bar{position:sticky; top:0; z-index:2; display:flex; justify-content:space-between; align-items:center; padding:20px 0; background:var(--bg); border-bottom:1px solid var(--border); margin-bottom:24px}
.gmodal-bar h3{font-size:1.1rem}
.gmodal-close{font:inherit; cursor:pointer; color:var(--text); background:transparent; border:1px solid var(--border); border-radius:8px; padding:8px 16px}
.gmodal-close:hover{border-color:var(--emerald); color:var(--emerald)}
.gmodal-grid{display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:16px; max-width:1100px; margin:0 auto}
.lb-btn{position:absolute; top:50%; transform:translateY(-50%); font-size:1.6rem; cursor:pointer; color:#fff; background:rgba(255,255,255,.12); border:0; border-radius:50%; width:48px; height:48px}
.lb-btn:hover{background:var(--emerald); color:#04150F}
#lb-prev{left:16px} #lb-next{right:16px}
.lb-count{position:absolute; bottom:16px; left:0; right:0; text-align:center; color:#CBD5E1; font-size:0.85rem}
.thumb{padding:0; border:1px solid var(--border); border-radius:8px; overflow:hidden; cursor:zoom-in; background:none; aspect-ratio:16/9}
.thumb img{width:100%; height:100%; object-fit:cover; display:block; transition:transform .25s ease}
.thumb:hover img{transform:scale(1.06)}
.gallery-empty{grid-column:1/-1; font-size:0.85rem; color:var(--text-dim)}
.gallery-empty code{color:var(--cat-color)}
.atelier-group{margin-top:16px}
.atelier-group:first-of-type{margin-top:10px}
.atelier-label{font-size:0.85rem; font-weight:600; color:var(--cat-color); margin-bottom:8px}
.dossier-row{display:flex; flex-wrap:wrap; gap:8px}
.gallery-toggle{font-size:0.82rem; padding:7px 12px}
.lightbox{position:fixed; inset:0; z-index:100; background:rgba(8,12,24,.92); display:flex; align-items:center; justify-content:center; padding:24px; cursor:zoom-out}
.lightbox[hidden]{display:none}
.lightbox img{max-width:90vw; max-height:85vh; width:auto; height:auto; object-fit:contain; border-radius:10px}

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
    <div class="logo">Oussama<span>.</span>dev</div>
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
    foreach ($modules as $m):$color = $catColors[$m['cat']] ?? 'var(--emerald)';
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
      <?php if ($m['code'] === 'M202'): ?>
      <div class="module-block">
        <h4>Ateliers</h4>
        <?php 
        $i = 0;
        foreach ($ateliers as$num => $dossiersList):$color = $atelierColors[$i % count($atelierColors)];$i++;
        ?>
        <div class="atelier-group">
          <?php if (!empty($dossiersList)): ?>
            <p class="atelier-label" style="--cat-color: <?php echo $color; ?>">Atelier <?php echo $num; ?></p>
            <div class="dossier-row">
              <?php foreach ($dossiersList as $d):$folder = 'images/ateliers/Atelier ' . $num . '/' .$d;
                $id = 'gal-atelier-' . $num . '-' . slugify($d);
                echo gallery_button($d,$folder, $id,$color);
              endforeach; ?>
            </div>
          <?php else: 
            $folder = 'images/ateliers/Atelier ' .$num;
            $id = 'gal-atelier-' .$num;
          ?>
            <div class="dossier-row">
              <?php echo gallery_button('Atelier ' . $num,$folder, $id,$color); ?>
            </div>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
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
      <a href="https://github.com/Oussama-Laaziz07/My-Portfolio" target="_blank" rel="noopener">GitHub</a>
      <a href="https://www.linkedin.com/in/oussama-laaziz-8690453a5/" target="_blank" rel="noopener">LinkedIn</a>
    </div>
  </div>
</footer>

<div class="gmodal" id="gmodal" hidden>
  <div class="gmodal-bar" style="max-width:1100px; margin-left:auto; margin-right:auto">
    <h3 id="gmodal-title"></h3>
    <button type="button" class="gmodal-close" id="gmodal-close">Fermer</button>
  </div>
  <div class="gmodal-grid" id="gmodal-grid"></div>
</div>

<div class="lightbox" id="lightbox" hidden>
  <button type="button" class="lb-btn" id="lb-prev" aria-label="Précédente">‹</button>
  <img alt="">
  <button type="button" class="lb-btn" id="lb-next" aria-label="Suivante">›</button>
  <div class="lb-count" id="lb-count"></div>
</div>

<script>
const modal=document.getElementById('gmodal'), mGrid=document.getElementById('gmodal-grid'), mTitle=document.getElementById('gmodal-title');
const lb=document.getElementById('lightbox'), lbImg=lb.querySelector('img'), lbCount=document.getElementById('lb-count');
let list=[], idx=0;
function show(i){ idx=(i+list.length)%list.length; lbImg.src=list[idx]; lbCount.textContent=(idx+1)+' / '+list.length; lb.hidden=false; }
function closeModal(){ modal.hidden=true; document.body.style.overflow=''; }
document.querySelectorAll('.gallery-toggle').forEach(btn=>{
  btn.addEventListener('click',()=>{
    const src=document.getElementById(btn.getAttribute('aria-controls'));
    mTitle.textContent=btn.dataset.title;
    mGrid.innerHTML=src.innerHTML;
    const thumbs=[...mGrid.querySelectorAll('.thumb')];
    list=thumbs.map(t=>t.dataset.full);
    thumbs.forEach((t,i)=>t.addEventListener('click',()=>show(i)));
    modal.hidden=false; document.body.style.overflow='hidden';
  });
});
document.getElementById('gmodal-close').addEventListener('click',closeModal);
document.getElementById('lb-prev').addEventListener('click',e=>{ e.stopPropagation(); show(idx-1); });
document.getElementById('lb-next').addEventListener('click',e=>{ e.stopPropagation(); show(idx+1); });
lb.addEventListener('click',()=>{ lb.hidden=true; });
document.addEventListener('keydown',e=>{
  if(!lb.hidden){
    if(e.key==='Escape') lb.hidden=true;
    if(e.key==='ArrowRight') show(idx+1);
    if(e.key==='ArrowLeft') show(idx-1);
  } else if(!modal.hidden && e.key==='Escape') closeModal();
});

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