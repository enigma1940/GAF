/* Code adapté */

$('.btnHome').click(function(){document.location.href="./";});

$('#ACC').addClass('active');

$('#PRO').click(function(){
    $('#PRO').addClass('active');
    $('#ACC').removeClass('active');
});

$('#textComplete').css('display', 'none');
$('.titleA').click(function(){
  if($($(this).attr('data')).css('display')=='none') $($(this).attr('data')).show('slow');
  else $($(this).attr('data')).hide('slow');
});

$('.searchForm').submit(function(e){
  e.preventDefault();
  if($('.searchText').val()){
    $('.searchResult').css('display','none');
    $('.Bienvenue').css('display', 'none');
    $('.Categories').css('display', 'none');
    $('.Nouvelles').css('display', 'none');
    $('.Articles').css('display', 'none');
    $('.Art').hide();
    $('.searchResult').html('<img src="images/loader.gif" />');
    $('.searchResult').toggle('drop');
    $.post(
      'php/searchResult.php',
      {search: $('.searchText').val()},
      function(data){$('.searchResult').html(data);}
    );
  }
});

$('.btnApropos').click(function(){
    $('.searchResult').css('display','none');
    $('.Bienvenue').css('display', 'none');
    $('.Recherche').css('display', 'none');
    $('.Categories').css('display', 'none');
    $('.Nouvelles').css('display', 'none');
    $('.Articles').css('display', 'none');
    $('.Art').hide();
    $('.a').hide();
    $('.searchResult').hide();
    $('.Apropos').html('<img src="images/loader.gif" />');
    $('.Apropos').show();
    $.post(
      'php/Apropos.php',
      function(data){$('.Apropos').html(data);}
    );
});


$('.searchForm2').submit(function(e){
  e.preventDefault();
  if($('.searchBar').val()!=''){

    if($('.annee option:selected').text()=='ANNEE' && $('.mois option:selected').text()=='MOIS'){
      //Recherche simple text
      $('.searchResult').css('display','none');
      $('.Bienvenue').css('display', 'none');
      $('.Categories').css('display', 'none');
      $('.Nouvelles').css('display', 'none');
      $('.Articles').css('display', 'none');
      $('.Art').hide();
      $('.searchResult').html('<img src="images/loader.gif" />');
      $('.searchResult').toggle('drop');
      $.post(
        'php/searchResult.php',
        {search: $('.searchBar').val()},
        function(data){$('.searchResult').html(data);}
      );
    }else if($('.annee option:selected').text()!='ANNEE' && $('.mois option:selected').text()=='MOIS'){
      //Recherche annee text
      $('.searchResult').css('display','none');
      $('.Bienvenue').css('display', 'none');
      $('.Categories').css('display', 'none');
      $('.Nouvelles').css('display', 'none');
      $('.Articles').css('display', 'none');
      $('.Art').hide();
      $('.searchResult').html('<img src="images/loader.gif" />');
      $('.searchResult').toggle('drop');
      $.post(
        'php/result.php',
        {opt: 'yearSearchText', year: $('.annee option:selected').text(), text: $('.searchBar').val()},
        function(data){$('.searchResult').html(data);}
      );
    }else if($('.annee option:selected').text()!='ANNEE' && $('.mois option:selected').text()!='MOIS'){
      $('.searchResult').css('display','none');
      $('.Bienvenue').css('display', 'none');
      $('.Categories').css('display', 'none');
      $('.Nouvelles').css('display', 'none');
      $('.Articles').css('display', 'none');
      $('.Art').hide();
      $('.searchResult').html('<img src="images/loader.gif" />');
      $('.searchResult').toggle('drop');
      $.post(
        'php/result.php',
        {opt: 'monthYearText', year: $('.annee option:selected').text(), mois: $('.mois option:selected').attr('value'), text: $('.searchBar').val()},
        function(data){$('.searchResult').html(data);}
      );
    }
  }else{

  }
});


$('.article').click(function(){
  $('.Bienvenue').css('display', 'none');
  $('.Categories').css('display', 'none');
  $('.Nouvelles').css('display', 'none');
  $('.Articles').css('display', 'none');
  $('.Art').show();
  $.ajax({
    type: "POST",
    url: 'php/openArticle.php',
    data: '&opt=openArticle&art='+$(this).children('.onearticle').val(),
    beforeSend: function(){/*$('.general').html('<img src="fonts/loader.gif" />');*/  $('.Art').html('<img src="images/loader.gif" />'); },
    success: function(data){ $('.Art').html(data); }
  });
});

$('#RechA').css('display', 'none');
$('#avancee').click(function(){
  $('#RechS').css('display', 'none');
  $('#RechA').css('display', 'block');
  $('.a').css('display', 'none');
});
$('#Ravancee').click(function(){
  $('#RechA').css('display', 'none');
  $('#RechS').css('display', 'block');
});

$('.Lois').css('display','none');
$('.Rapports').css('display','none');
$('.catactiveA').css('color','firebrick');

$('.catactiveA').click(function(){
  $('.catactiveB').css('color','dimgrey');
  $('.catactiveC').css('color','dimgrey');
  $('.catactiveA').css('color','firebrick');
  $('.Nouvelles').css('display','block');
  $('.Conseil').css('display','block');
  $('.Lois').css('display','none');
  $('.Rapports').css('display','none');
});

$('.catactiveB').click(function(){
  $('.catactiveA').css('color','dimgrey');
  $('.catactiveB').css('color','firebrick');
  $('.catactiveC').css('color','dimgrey');
  $('.Nouvelles').css('display','none');
  $('.Conseil').css('display','none');
  $('.Rapports').css('display','none');
  $('.Lois').css('display','block');
});

$('.catactiveC').click(function(){
  $('.catactiveA').css('color','dimgrey');
  $('.catactiveB').css('color','dimgrey');
  $('.catactiveC').css('color','firebrick');
  $('.Nouvelles').css('display','none');
  $('.Conseil').css('display','none');
  $('.Rapports').css('display','block');
  $('.Lois').css('display','none');
});


if($('.indicator').val()=='0'){
  $('.catactiveA').css('color','dimgrey');
  $('.catactiveB').css('color','firebrick');
  $('.catactiveC').css('color','dimgrey');
  $('.Nouvelles').css('display','none');
  $('.Conseil').css('display','none');
  $('.Rapports').css('display','none');
  $('.Lois').css('display','block');
};

if($('.indicator').val()=='1'){
  $('.catactiveA').css('color','dimgrey');
  $('.catactiveB').css('color','dimgrey');
  $('.catactiveC').css('color','firebrick');
  $('.Nouvelles').css('display','none');
  $('.Conseil').css('display','none');
  $('.Rapports').css('display','block');
  $('.Lois').css('display','none');
};