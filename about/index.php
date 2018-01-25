<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GAF - A propos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/home.css" rel="stylesheet" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
  </head>
  <body>
    <header class="row blue darken-2">
      <div class="logo col m1 hide-on-med-and-down">
        <img src="../fonts/logo.png" style="width: 100%;" />
      </div>
      <div class="col l6 m6 title valign-wrapper hide-on-med-and-down">
        Gouvernance Accès Facile
      </div>
      <div class="col m5 valign-wrapper flow-text hide-on-large-only">
        Gouvernance Accès Facile
      </div>
      <a href="../" style="color: white;"<div class="col m2 l1 menuItem waves-effect waves-light btnHome"><font>Accueil</font></div></a>
    </header>

    <div class="row">
      <div class="col m12 s12 l10 offset-l1">
        <div class="row"><h3 class="ttt" data="#i1">Problématique</h3></div>
        <div class="row"><div class="col m12" id="i1">
        <p class="flow-text" style="text-align:justify;">Les 30 et 31 octobre 2014, suite à la tentative de modification de l’article 37 limitant les mandats présidentiels à deux, le peuple Burkinabè en une insurrection populaire a chassé du pouvoir l’ex président Blaise Compaoré. En 97 une même tentative, celle là réussie, est passée comme une lettre à la poste sur proposition de loi en conseil de ministres. la vigilance citoyenne était absente, les outils pour la mettre en exergue manquaient...</p></div></div>

        <div class="row"><h3 class="ttt" data="#i2">Contexte</h3></div>
        <div class="row"><div class="col m12" id="i2">
        <p class="flow-text" style="text-align:justify;">Le Burkina Faso est aujourd’hui dans une situation post-révolutionnaire. L’opinion publique s’est renforcée et exige transparence, justice et clarté dans les décisions. 71,3% de la population est analphabète. Les notions de redevabilité, de bonne gouvernance, de citoyenneté, de démocratie sont peu accessibles</p></div></div>

        <div class="row"><h3 class="ttt" data="#i3">Des données aux impacts : Résultats et opportunités</h3></div>
        <div class="row">
        <div class="col m12" id="i3">
        <p class="flow-text" style="text-align:justify;">Un outil simple permet de rechercher une information précise tout en contribuant à l’analyser, à mémoriser et rappeler une information, une échéance, et ainsi lancer une alerte lorsqu’elle est nécessaire</p>

        <p class="flow-text" style="text-align:justify;">Les populations comprennent mieux l’enjeu et le contexte des décisions qui sont prises, le contrôle citoyen est accru</p>

        <p class="flow-text" style="text-align:justify;">Les gouvernants se sentent redevables, les nominations ne sont plus complaisantes, les entreprises ne sont plus ultra-attributaires, la corruption diminue conséquemment.</p>
      </div></div>
      </div>
    </div>
    <footer class="row" style="border-top: solid 2px #222;">
      <div class="col m12 flow-text">Partenaires : <div>
      <div class="col m3 l2 s3 p"><img src="../fonts/etalab.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="../fonts/opendata.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="../fonts/bmi.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="../fonts/cfi.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="../fonts/ogp.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="../fonts/jokko.png" style="max-height: 50px; max-width: 100%;" /></div>
    </footer>
    <script type="text/javascript">
      $('#i2').hide();
      $('#i3').hide();$('h3').css({'cursor': 'pointer'});

      $('h3').click(function(){
        $($(this).attr('data')).toggle('slow');
      });
    </script>
  </body>
</html>
