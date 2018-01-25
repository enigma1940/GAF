function zoomEvent(month, name, year){
  var months=['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juillet', 'Août', 'Sep', 'Oct', 'Nov', 'Dec'];
  var m = months.indexOf(month);
  $.post(
    '../php/statUtils.php',
    {
      opt: 'zoom',
      sect: name,
      month: m+1,
      year: year.replace(/\s/g,'')
    },
    function(data){
      $('.resultCol').html(data);
    }
  );
  $('.zoomTitle').html(name+' '+month+'/'+year);
  try{
    //var page = $(this).attr('data');
    var speed = 500;
    $('html, body').animate( { scrollTop: $('.zoomTitle').offset().top }, speed ); // Go
    //return false;
  }catch(err){
    //return false;
  }
}

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
        categories: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juillet', 'Août', 'Sep', 'Oct', 'Nov', 'Dec'],
    },
  plotOptions: {
      series: {
          pointStart: 0,
          point: {
             events: {
                click: function() {
                    zoomEvent(this.category, this.series.name, $("#curYear").val());
                    //alert ('X: '+this.x+ ' Category: '+ this.category +', value: '+ this.y+' name: '+this.series.name);
                }
            }
        }
      }
  },
  /*tooltip: {
    formatter: function() {
        return 'The value for <b>' + this.x + '</b> is <b>' + this.y + '</b>, in series '+ this.series.name;
    }
  },*/
  series: [{
        name: 'Délibérations',
    }, {
        name: 'Nominations',
    },{
        name: 'Communication Orales'
    }
  ],
});

var delib = new Array(), com = new Array(), nom = new Array();

$.getJSON(
  '../php/drawer.php',
  {option: 'yearInfo', year: $('#curYear').val()},
  function(data){
    for(var j=0; j<12; j++){
      delib.push(parseFloat(data.delib[j]));
      nom.push(parseFloat(data.nom[j]));
      com.push(parseFloat(data.com[j]));
    }
    c.series[0].setData(delib);
    c.series[1].setData(nom);
    c.series[2].setData(com);
    c.redraw();
  }
);

$('.oneYear').click(function(){
  delib = new Array(), com = new Array(), nom = new Array();
  $('.load-area').toggle('fade');
  $('#curYear').val($(this).html());
  $.getJSON(
    '../php/drawer.php',
    {option: 'yearInfo', year: parseFloat($(this).html())},
    function(data){
      for(var j=0; j<12; j++){
        delib.push(parseFloat(data.delib[j]));
        nom.push(parseFloat(data.nom[j]));
        com.push(parseFloat(data.com[j]));
      }
      c.series[0].setData(delib);
      c.series[1].setData(nom);
      c.series[2].setData(com);
      c.redraw();
      $('.load-area').toggle('fade');
    }
  );
});
