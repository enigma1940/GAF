<?php
  include_once('connectdb.php');
  $cr;
  $title=buildString(htmlspecialchars($_POST['search']), 'title');
  $content=buildString(htmlspecialchars($_POST['search']), 'content');
  $deliberation=buildString(htmlspecialchars($_POST['search']), 'deliberation');
  $nomination=buildString(htmlspecialchars($_POST['search']), 'nomination');
  $communication=buildString(htmlspecialchars($_POST['search']), 'communication');
  $cr=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE ('.$title.') OR ('.$content.') OR ('.$deliberation.') OR ('.$nomination.') OR ('.$communication.') ORDER BY ID DESC');
  $cr->execute();
  if($cr->rowCount()==0){
    $ti=correctString(htmlspecialchars($_POST['search']), 'title');
    $co=correctString(htmlspecialchars($_POST['search']), 'content');
    $de=correctString(htmlspecialchars($_POST['search']), 'deliberation');
    $no=correctString(htmlspecialchars($_POST['search']), 'nomination');
    $com=correctString(htmlspecialchars($_POST['search']), 'communication');
    $cr=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE ('.$ti.') OR ('.$co.') OR ('.$de.') OR ('.$no.') OR ('.$com.') ORDER BY ID DESC');
    $cr->execute();
  }
?>

<div class="col s12 m12">
  <div class="row swi">
    <div class="col s3 m3 it" data=".crZone" style="background:#ccc;">
      Compte rendu
      <div style="float: right;"><font style="background:rgb(80, 0, 117); color:#fff;" class="ct right"><?php echo $cr->rowCount(); ?></font></div>
    </div>
    <div class="col s4 m4 it" data=".txtZone" style="background:rgb(80, 0, 117); color: white; border-left: solid 1px #ccc; border-right: solid 1px #ccc;">
      Textes de loi
      <font style="background:rgb(80, 0, 117); color:#fff;" class="ct right">0</font>
    </div>
    <div class="col s3 m3 it" data=".rapZone" style="background:rgb(80, 0, 117); color: white;">
      Rapports<font style="background:rgb(80, 0, 117); color:#fff;" class="ct right">0</font>
    </div>
    <div class="col s1 m1"><button class="btn-floating orange waves-effect waves-light backSearch"><i class="material-icons left">arrow_back</i></button></div>
  </div>
  <div class="row" style="background: #e2e2e2;">
    <div class="col m12 crZone">
      <?php
        if($cr->rowCount()>0){
        while($data=$cr->fetch()){
          echo '<div class="col s12 m8 resultItem">
            <font class="col s8 m8 artTitle">'.$data['title'].'</font>
            <font class="col s4 m4 dateA" style="float:right;">'.$data['datea'].'</font>
            <input type="hidden" class="aid" value="'.$data['ID'].'" />
            </div>';}
          }else{
            echo '<h4>Aucun résultat</h4>';
          }
        ?>
      </div>
      <div class="col s12 m12 txtZone" style="display: none;"><h4>Inactif</h4></div>
      <div class="col s12 m12 rapZone" style="display: none;"><h4>Inactif</h4></div>
    </div>
</div>

<style>.it{cursor: pointer;}
  .ct{border-radius:10px; text-align: center; /*padding-left: 10px; padding-right: 10px;*/padding: 3px 14px 3px 14px; font-size: 16px; border: solid .5px #ccc;}
  .swi div{line-height: 40px; /*text-align: center;*/}
  .swi{margin: 0px;}
  .resultItem{line-height: 40px; margin-top: 5px; cursor: pointer; border-bottom: solid 1px #333;}
  .resultItem:hover{border-left: solid 5px rgb(80, 0, 117); transition-duration: .2s;}
  .resultItem .artTitle{color: #333; font-size: 15px;}
  .resultItem .dateA{color: rgb(0, 144, 226); font-size: 18px;}
</style>
<script type="text/javascript">
  $('.resultItem').click(function(){
    $('.searchResult').css('display','none');
    $('.bigArea').css('display','block');

    $('.catArea').css('display', 'none');
    $('.articles').css('display', 'none');
    $('.paginator').css('display', 'none');
    $.ajax({
      type: "POST",
      url: 'php/openArticle.php',
      data: '&opt=openSArticle&art='+$(this).children('.aid').val(),
      beforeSend: function(){/*$('.general').html('<img src="fonts/loader.gif" />');*/  $('.lastArticle').html('<img src="fonts/loader.gif" />'); },
      success: function(data){ $('.lastArticle').html(data); }
    });
  });

  function clearZone(){
    $('.crZone').css('display','none');
    $('.txtZone').css('display','none');
    $('.rapZone').css('display','none');
  }
  $('.it').click(function(){
      clearZone();
      $('.it').css({'background':'rgb(80, 0, 117)','color': 'white'});
      $(this).css({'background':'#ccc','color': 'black'});
      $($(this).attr('data')).toggle('drop');
  });
  $('.backSearch').click(function(){
    $('.searchResult').css('display', 'none');
    $.post(
      'php/openArticle.php',
      {opt:'last'},
      function(data){$('.lastArticle').html(data);}
    );
    $('.bigArea').toggle('drop');
  });
</script>
