<?php
  include_once('php/connectdb.php');
  function loadclass($class) {
    include 'php/classes/' .$class. '.class.php';
  }
  spl_autoload_register('loadclass');
  $search = new Search();
  echo '<input type="hidden" value="0" class="indicator" />';
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gouvernance Accès Facile - Votre plateforme de veille citoyenne au Burkina Faso</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css"/>

    <meta name="description" content="Accédez aux comptes rendus des conseils des ministres, aus textes de lois, et aux rapports des institutions publiques... Gouvernance Accès Facile votre plateforme de veille citoyenne!" />	

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!--script type="text/javascript" src="js/owl.carousel.min.js"></script-->
  </head>
  <body>
    <!--p style="display: none;">Gouvernance Accès Facile est une plateforme de veille citoyenne
 pour tout citoyen du Burkina Faso. Compte rendu des conseils des ministres, Textes de lois 
et Rapports des institutions publiques... Accédez aux information facilement!!!</p-->

    <header class="row blue darken-3" style="margin-bottom: 0px !important;">

   <div class="col m12 description" style="display: none;">Gouvernance Accès Facile est une plateforme de veille citoyenne 
 pour tout citoyen du Burkina Faso. Compte rendu des conseils des ministres, Textes de lois 
et Rapports des institutions publiques... Accédez aux information facilement!!!</div>
    
      <div class="col m12 white"><img src="fonts/logo.png" style="max-width: 100%; width: 300px;" /></div>
      <div class="col l6 m6 title valign-wrapper hide-on-med-and-down">
        Gouvernance Accès Facile
      </div>
      <div class="col m5 valign-wrapper flow-text hide-on-large-only">
        Gouvernance Accès Facile
      </div>
      <div class="col m2 l1 menuItem waves-effect waves-light btnHome"><font>Accueil</font></div>
      <a class="js-scroll" data=".catArea" style="color: #fff;"><div class="col m2 l1 menuItem waves-effect waves-light"><font>Catégories</font></div></a>
      <a class="js-scroll" data=".thing" style="color: #fff;"><div class="col m2 l1 menuItem waves-effect waves-light"><font>Articles</font></div></a>
      <a href="./about" style="color: #fff;"><div class="col m2 l1 menuItem waves-effect waves-light"><font>A propos</font></div></a>
      <a href="./statistiques" style="color: #fff;"><div class="col m2 l1 menuItem waves-effect waves-light"><font>Statistiques</font></div></a>
    </header>

    <div class="row sssc">
      <div class="col m12 searchArea">
        <form class="searchForm2 col s12 m12 l10 offset-l1">
          <div class="search-wrapper col s12 m6 l5" style="margin: 0px;">
            <div class="col s2 m2"><i class="material-icons right material-icons">search</i></div>
            <input type="text" class="searchBar col m10 s10" placeholder="Rechercher" />
          </div><div class="param col s7 m7 l2" style="padding: 0px;">
          <select class="annee col s6 m6"><option>Année ? </option><?php $search->years($bdd); ?></select>
          <select class="mois col s6 m6"><option>Mois ? </option><?php $search->months($bdd); ?></select></div>
          <div class="col l5 hide-on-med-and-down">
            <button type="submit" class="btn waves-effect waves-light blue darken-2" style="border-radius:15px;"><i class="material-icons left">search</i>Recherche</button>
            <a class="btn waves-effect waves-light grey darken-3 btnBackForm" style="border-radius:15px;"><i class="material-icons left">settings</i>Avancé</a>
          </div>
            <div class="col s5 m5 hide-on-large-only">
              <button type="submit" class="btn-floating waves-effect waves-light blue darken-2"><i class="material-icons">search</i></button>
              <a class="btn-floating waves-effect waves-light grey darken-2 btnBackForm"><i class="material-icons">settings</i></a>
            </div>
        </form>
      </div>

    </div>
    <div class="row bigArea">

      <div class="row catArea grey darken-3" style="color: white;">
        <div class="col s12 m4">
          <div class="col m12 btnConseil catItem waves-effect" style="border-bottom: solid 4px #fff;">
            <div class="col m12"><center><img src="fonts/sheet2.png" class="imc" /></center></div>
            <div class="col m12 catCaption"><font>Compte rendu</font></div>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="col m12 btnLois catItem waves-effect">
            <div class="col m12"><center><img src="fonts/law2.png" class="iml" /></center></div>
            <div class="col m12 catCaption"><font>Textes de loi</font></div>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="col m12 btnRapport catItem waves-effect">
            <div class="col m12"><center><img src="fonts/report2.png" class="imr" /></center></div>
            <div class="col m12 catCaption"><font>Rapports</font></div>
          </div>
        </div>
      </div>
      <div class="thing row"></div>
    </div>
    <div class="row searchResult"></div>

    <footer class="row" style="border-top: solid 2px #222;">
      <div class="col m12 flow-text">Partenaires : <div>
      <div class="col m3 l2 s3 p"><img src="fonts/etalab.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="fonts/opendata.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="fonts/bmi.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="fonts/cfi.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="fonts/ogp.png" style="max-height: 50px; max-width: 100%;" /></div>
      <div class="col m3 l2 s3 p"><img src="fonts/jokko.png" style="max-height: 50px; max-width: 100%;" /></div>
    </footer>
    <script src="js/home.js"></script>

  </body>
</html>
