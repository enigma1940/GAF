<?php
  require_once('connectdb.php');
  $lc = $bdd->query('SELECT c.ID, c.title, c.datea, substr(a.content, 1, 200) as txt from conseil c, article a WHERE c.ID=a.ID ORDER BY c.ID DESC LIMIT 0,6');
  require_once('classes/Article.class.php');
?>
  <div class="row lastArticle">
    <?php
        $a = new Article();
        $r = $bdd->query('SELECT MAX(ID) as m FROM conseil');
        $d = $r->fetch();
        $a->setId($d['m']); $a->read($bdd);
      ?>
      <div class="col m10 offset-m1">
        <h4 class="titleA" data="#textComplete"><?php echo $a->getTitle(); ?><span style="font-size: 12px; color: #333;">  ( Cliquer pour lire) </span></h4>
        <div class="col m12" id="textComplete"><?php echo $a->getContent().$a->getDeliberation().$a->getCommunication().$a->getNomination(); ?></div>
      </div>
  </div>
  <div class="row articles">
    <?php
      while($data = $lc->fetch()){
        if(strlen($data['title'])>62){$data['title']=substr($data['title'], 0, 62).'..';}
        $cn=$bdd->prepare('SELECT COUNT(*) as n FROM comment WHERE conseil=?');
        $cn->execute(array($data['ID']));
        $dn=$cn->fetch();
        echo '<div class="col s12 m6 l6"><div class="col m12 article">
          <input type="hidden" class="onearticle" value="'.$data['ID'].'" />
          <div class="col m12 titlearticle">'.$data['title'].'</div>
          
          <div class="col m12 footarticle"><font class="left datea" style="border-radius: 7px 7px 0px 0px;">'.$data['datea'].'</font><font class="right nbcom hide-on-med-and-down">Commentaires: '.$dn['n'].'</font>
          <font class="hide-on-large-only right" style="border-radius: 2px; background: rgb(0, 74, 106); color: white;">'.$dn['n'].'</font></div>
        </div>
      </div>';
      }
    ?>
  </div>

  <?php $pg=$bdd->query('SELECT COUNT(*) AS m FROM conseil');
    $d = $pg->fetch();
    $max=(ceil($d['m']/6));
    echo '<input type="hidden" class="maxPage" value="'.$max.'"><input type="hidden" class="curPage" value="1" />';
  ?>

  <div class="container-fluid paginator"><center><?php
    echo '<font class="prev waves-effect waves-red"><i class="material-icons">chevron_left</i></font><font class="aPage">1</font><font class="aPage">2</font><font class="aPage">3</font>...<font class="aPage">'.$max.'</font><font class="next waves-effect waves-red"><i class="material-icons">chevron_right</i></font>';
    ?></center>
  </div>
<script>
  $('#textComplete').css('display', 'none');
  $('.titleA').click(function(){
  if($($(this).attr('data')).css('display')=='none') $($(this).attr('data')).show('slow');
  else $($(this).attr('data')).hide('slow');
});
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
      {opt:'mod', page:$('.curPage').val()},
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
      data: '&opt=mod&page='+$('.curPage').val(),
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
      data: '&opt=mod&page='+$(this).html(),
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
      data: '&opt=mod&page=1',
      beforeSend: function(){$('.articles').html('<img src="fonts/loader.gif" />');},
      success: function(data){$('.articles').html(data);}
    });
  }
  $(this).css({'background':'rgb(150, 0, 0)', 'color':'#fff'});
});
</script>
<style>
  .subArticle{font-size: 20px; color: /*rgb(95, 0, 140)*/ rgb(0, 122, 249); font-style: bold;}
</style>
