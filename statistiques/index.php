<?php
  require('../php/connectdb.php');
  require('../php/classes/Search.class.php');
  $r=new Search();
?>
<meta charset="utf-8" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<title>GAF::Statistiques</title>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<header class="row blue darken-3" style="margin-bottom: 0px !important;">
  <div class="col l6 m6 title valign-wrapper hide-on-med-and-down">
    Gouvernance Accès Facile
  </div>
  <div class="col m5 valign-wrapper flow-text hide-on-large-only">
    Gouvernance Accès Facile
  </div>
  <a href="../" style="color: #fff;"><div class="col m2 l1 menuItem waves-effect waves-light btnHome"><font>Accueil</font></div></a>
  <a href="./about" style="color: #fff;"><div class="col m2 l1 menuItem waves-effect waves-light"><font>A propos</font></div></a>
</header>
<h4>Statistiques</h4>
<input type="text" id="curYear" value="<?php echo $r->getLastYear($bdd); ?>" />
<div class="row">
<?php
  foreach($r->getYears($bdd) as $key=>$value){ ?>
  <div class="oneYear">
    <?php echo $value; ?>
  </div>
<?php } ?>
</div>
<div class="row load-area" style="margin-bottom: 0px !important;">
  <center><img src="../fonts/loader.gif" style="width: 80px; height: 80px; display: none;" /></center>
</div>

<div class="row" id="diag0"></div>
<div class="row zoomZone">
  <div class="container zoomData" style="">
    <font class="flow-text col m12 zoomTitle"></font>
    <div class="resultCol col l10 m12">

    </div>
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
<style>
  .oneYear{line-height: 50px; width:50px; border-radius: 50%; text-align: center; background: rgb(0, 80, 85); display: inline-block; font-size: 17px;
      color: white; cursor: pointer;}
  .oneYear:hover{background: rgb(199, 199, 199); color: #333; transition-duration: .3s;}
  .p{text-align: center;}
  header{color: #fff;/* margin-bottom: 0px !important;*/}
  .title, .menuItem{text-align: center;}
  .menuItem{line-height: 50px;}
  .title{font-size: 30px;}
</style>

<script type="text/javascript" src="../js/stat.js"></script>
