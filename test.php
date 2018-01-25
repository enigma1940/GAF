<?php
  require('php/connectdb.php');
  require('php/classes/Search.class.php');
  $r=new Search();
?>
<meta charset="utf-8" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<h4>Statistiques</h4>
<div class="row">
<?php
  foreach($r->getYears($bdd) as $key=>$value){ ?>
  <div class="oneYear">
    <?php echo $value; ?>
  </div>
<?php } ?>
</div>

<div class="row" id="diag0"></div>

<style>
  .oneYear{line-height: 50px; width:50px; border-radius: 50%; text-align: center; background: rgb(0, 80, 85); display: inline-block; font-size: 17px;
      color: white; cursor: pointer;}
  .oneYear:hover{background: rgb(199, 199, 199); color: #333; transition-duration: .3s;}
</style>

<script type="text/javascript">

var tab = new Array();//new Array();
var c = new Highcharts.chart('diag0', {
  title: {
      text: 'Vue des activités'
  },
  legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle'
  },
  xAxis: {
        categories: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juillet', 'Août', 'Sep', 'Oct', 'Nov', 'Dec']
    },
  plotOptions: {
      series: {
          pointStart: 0
      }
  },
  series: [{
        name: 'Délibérations',
    }, {
        name: 'Nominations',
    },{
        name: 'Communication Orales'
    }
   ]
});
var delib = new Array(), com = new Array(), nom = new Array();
$.getJSON(
  'php/drawer.php',
  {option: 'yearInfo', year: 2017},
  function(data){
    for(var j=0; j<12; j++){
      delib.push(parseFloat(data.delib[j]));
      nom.push(parseFloat(data.nom[j]));
      com.push(parseFloat(data.com[j]));
    }
    c.series[0].setData(delib);
    c.series[1].setData(com);
    c.series[2].setData(nom);
    c.redraw();
  }
);

$('.oneYear').click(function(){
  delib = new Array(), com = new Array(), nom = new Array();
  $.getJSON(
    'php/drawer.php',
    {option: 'yearInfo', year: parseFloat($(this).html())},
    function(data){
      for(var j=0; j<12; j++){
        delib.push(parseFloat(data.delib[j]));
        nom.push(parseFloat(data.nom[j]));
        com.push(parseFloat(data.com[j]));
      }
      c.series[0].setData(delib);
      c.series[1].setData(com);
      c.series[2].setData(nom);
      c.redraw();
    }
  );
});

</script>
