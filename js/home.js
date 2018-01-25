$('.btnHome').click(function(){document.location.href="./";});
$('.thing').html('<img src="fonts/loader.gif" />');
$.post(
  'php/conseil.php',{},
  function(data){$('.thing').html(data);}
);

$('.js-scroll').on('click', function() {
  try{
    var page = $(this).attr('data');
    var speed = 500;
    $('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
    return false;
  }catch(err){
    return false;
  }
});

function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 4500);
}
$('.carousel').carousel({full_width: true, time_constant: 100});
autoplay();

$('.btnConseil').click(function(){
//  if($('.indicator').val()!='0'){
//    $('.indicator').attr('value', '0');
    $('.thing').html('<img src="fonts/loader.gif" />');
    $.post(
      'php/conseil.php',{},
      function(data){$('.thing').html(data);}
    );
    $('.catItem').css('border-bottom', 'none');
    $(this).css('border-bottom', 'solid 4px #fff');
//  }
});
$('.btnLois').click(function(){
  //if($('.indicator').val()!='1'){
  //  $('.indicator').attr('value', '1');
    $('.thing').html('<center><img src="fonts/loader.gif" /></center>');
    $.post(
      'php/lois.php',{},
      function(data){$('.thing').html(data);}
    );
    $('.catItem').css('border-bottom', 'none');
    $(this).css('border-bottom', 'solid 4px #fff');
  //}
});
$('.btnRapport').click(function(){
  //if($('.indicator').val()!='2'){
  //  $('.indicator').attr('value', '2');
    $('.thing').html('<center><img src="fonts/loader.gif" /></center>');
    $.post(
      'php/rapport.php',{},
      function(data){$('.thing').html(data);}
    );
    $('.catItem').css('border-bottom', 'none');
    $(this).css('border-bottom', 'solid 4px #fff');
  //}
});


$('select').material_select();

$('.btnAdvance').click(function(){
  $('.searchForm').hide();
  $('.searchForm2').toggle('drop');
});
$('.btnBackForm').click(function(){
  $('.param').toggle('fade');
});

$('.searchForm2').submit(function(e){
  e.preventDefault();
  if($('.searchBar').val()!=''){

    if($('.annee option:selected').text()=='Année ? ' && $('.mois option:selected').text()=='Mois ? '){
      //Recherche simple text
      $('.searchResult').css('display','none');
      $('.bigArea').css('display', 'none');
      $('.searchResult').html('<center><img src="fonts/loader.gif" /></center>');
      $('.searchResult').toggle('drop');
      $.post(
        'php/searchResult.php',
        {search: $('.searchBar').val()},
        function(data){$('.searchResult').html(data);}
      );
    }else if($('.annee option:selected').text()!='Année ? ' && $('.mois option:selected').text()=='Mois ? '){
      //Recherche annee text
      $('.searchResult').css('display','none');
      $('.bigArea').css('display', 'none');
      $('.searchResult').html('<center><img src="fonts/loader.gif" /></center>');
      $('.searchResult').toggle('drop');
      $.post(
        'php/result.php',
        {opt: 'yearSearchText', year: $('.annee option:selected').text(), text: $('.searchBar').val()},
        function(data){$('.searchResult').html(data);}
      );
    }else if($('.annee option:selected').text()!='Année ? ' && $('.mois option:selected').text()!='Mois ? '){
      $('.searchResult').css('display','none');
      $('.bigArea').css('display', 'none');
      $('.searchResult').html('<center><img src="fonts/loader.gif" /></center>');
      $('.searchResult').toggle('drop');
      //alert($('.mois option:selected').attr('value'));
      $.post(
        'php/result.php',
        {opt: 'monthYearText', year: $('.annee option:selected').text(), mois: $('.mois option:selected').attr('value'), text: $('.searchBar').val()},
        function(data){$('.searchResult').html(data);}
      );
    }
  }else{
  }
});
