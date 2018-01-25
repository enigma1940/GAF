<?php
  require_once('connectdb.php');
  $lc = $bdd->query('SELECT ID, title, filelink from rapport ORDER BY ID DESC LIMIT 0,6');
?>
<div class="popup"></div>
  <div class="row articles">
    <?php
      while($data = $lc->fetch()){
        $data['filelink']='www.planificationfamiliale-burkinafaso.net/'.$data['filelink'];
        echo '<div class="col s12 m6 l6"><div class="col m12 loiArt z-depth-2">
          <input type="hidden" class="onearticle" value="'.$data['ID'].'" />
          <div class="col m12 titlearticle">'.$data['title'].'</div>
          <div class="col m12 footarticle">

            <a class="btn waves-effect grey darken-3 waves-light" type="application/pdf" href="'.$data['filelink'].'"><i class="material-icons left">file_download</i>Télécharger</a>
          </div>
        </div>
      </div>';
      }
    ?>
  </div>

  <?php $pg=$bdd->query('SELECT COUNT(*) AS m FROM rapport');
    $d = $pg->fetch();
    $max=(ceil($d['m']/6));
    echo '<input type="hidden" class="maxPage" value="'.$max.'"><input type="hidden" class="curPage" value="1" />';
  ?>

  <div class="container-fluid paginator"><center><?php
    echo '<font class="prev waves-effect waves-red"><i class="material-icons">chevron_left</i></font><font class="aPage">1</font><font class="aPage">2</font><font class="aPage">3</font>...<font class="aPage">'.$max.'</font><font class="next waves-effect waves-red"><i class="material-icons">chevron_right</i></font>';
    ?></center>
  </div>
<script>
$('.article').click(function(){
  $('.catArea').css('display', 'none');
  $('.articles').css('display', 'none');
  $('.paginator').css('display', 'none');
  $.ajax({
    type: "POST",
    url: 'php/openArticle.php',
    data: '&opt=openArticle&art='+$(this).children('.onearticle').val(),
    beforeSend: function(){/*$('.general').html('<img src="fonts/loader.gif" />');*/  $('.lastArticle').html('<img src="fonts/loader.gif" />'); },
    success: function(data){ $('.lastArticle').html(data); }
  });
});
$('.paginator').on('click', '.next', function(){
  if(parseFloat($('.curPage').val())<parseFloat($('.maxPage').val())){
    $('.curPage').attr('value', parseFloat($('.curPage').val())+1);
    /*$.ajax({
      type: "POST",
      url: 'php/page.php',
      data: '&opt=mod&page='+$('.curPage').val(),
      beforeSend: function(){$('.articles').html('<img src="fonts/loader.gif" />');},
      success: function(data){$('.articles').html(data);}
    });*/
    $('.articles').html('<img src="fonts/loader.gif" />');
    $.post(
      'php/page.php',
      {opt:'rapportp', page:$('.curPage').val()},
      function(data){$('.articles').html(data);}
    );

    if(parseFloat($('.curPage').val())<($('.maxPage').val()-1) && parseFloat($('.curPage').val())!=1){
      var n = $('.maxPage')-parseFloat($(this).html());
      $('.paginator').html('<center><font class="prev waves-effect waves-red"><i class="material-icons">chevron_left</i></font><font class="aPage">1</font>..<font class="aPage" style="background:rgb(150, 0, 0); color:white;">'+(parseFloat($('.curPage').val()))+'</font><font class="aPage">'+(parseFloat($('.curPage').val())+1)+'</font><font class="aPage">'+(parseFloat($('.curPage').val())+2)+'</font>...<font class="aPage">'+$('.maxPage').val()+'</font><font class="next waves-effect waves-red"><i class="material-icons">chevron_right</i></font></center>');
    }
  }
});
$('.paginator').on('click', '.prev', function(){
  if(parseFloat($('.curPage').val())>1){
    $('.curPage').attr('value', parseFloat($('.curPage').val())-1);
    $.ajax({
      type: "POST",
      url: 'php/page.php',
      data: '&opt=rapportp&page='+$('.curPage').val(),
      beforeSend: function(){$('.articles').html('<img src="fonts/loader.gif" />');},
      success: function(data){$('.articles').html(data);}
    });

    if(parseFloat($('.curPage').val())<($('.maxPage').val()-1) && parseFloat($('.curPage').val())!=1){
      var n = $('.maxPage')-parseFloat($(this).html());
      switch(n){
        case 2:
          break;
        case 3:
          break;
        default:
            $('.paginator').html('<center><font class="prev waves-effect waves-red"><i class="material-icons">chevron_left</i></font><font class="aPage">1</font>..<font class="aPage" style="background:rgb(150, 0, 0); color:white;">'+(parseFloat($('.curPage').val()))+'</font><font class="aPage">'+(parseFloat($('.curPage').val())+1)+'</font><font class="aPage">'+(parseFloat($('.curPage').val())+2)+'</font>...<font class="aPage">'+$('.maxPage').val()+'</font><font class="next waves-effect waves-red"><i class="material-icons">chevron_right</i></font></center>');
          break;
      }
    }
  }
});
  $('.paginator').on('click', '.aPage', function(){
  $('.curPage').attr('value', $(this).html());
  if(parseFloat($(this).html())>1){
    $('.aPage').css({'background':'#ccc', 'color':'black'});
    $.ajax({
      type: "POST",
      url: 'php/page.php',
      data: '&opt=rapportp&page='+$(this).html(),
      beforeSend: function(){$('.articles').html('<img src="fonts/loader.gif" />');},
      success: function(data){$('.articles').html(data);}
    });

    if(parseFloat($(this).html())<($('.maxPage').val()-1) && parseFloat($(this).html())!=1){
      var n = $('.maxPage')-parseFloat($(this).html());
      switch(n){
        case 2:
          break;
        case 3:
          break;
        default:
            $('.paginator').html('<center><font class="prev waves-effect waves-red"><i class="material-icons">chevron_left</i></font><font class="aPage">1</font><font class="aPage" style="background:rgb(150, 0, 0); color:white;">'+(parseFloat($(this).html()))+'</font><font class="aPage">'+(parseFloat($(this).html())+1)+'</font><font class="aPage">'+(parseFloat($(this).html())+2)+'</font>...<font class="aPage">'+$('.maxPage').val()+'</font><font class="next waves-effect waves-red"><i class="material-icons">chevron_right</i></font></center>');
          break;
      }
    }
  }else{
    $('.aPage').css({'background':'#ccc', 'color':'black'});
    $.ajax({
      type: "POST",
      url: 'php/page.php',
      data: '&opt=rapportp&page=1',
      beforeSend: function(){$('.articles').html('<img src="fonts/loader.gif" />');},
      success: function(data){$('.articles').html(data);}
    });
  }
  $(this).css({'background':'rgb(150, 0, 0)', 'color':'#fff'});
});
</script>
<style>
  .loiArt{border-radius: 5px; cursor: pointer; margin-bottom: 10px; background: #ccc; height: 125px;}
  .loiArt .titlearticle{font-size: 20px; text-align: center; color: #111;}
</style>
