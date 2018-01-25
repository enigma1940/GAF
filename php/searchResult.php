<?php
  include_once('connectdb.php');
  $cr;
  $reqString=buildString2(htmlspecialchars($_POST['search']));
  $cr=$bdd->prepare($reqString);
  $cr->execute();
?>

<div class="col s12 m12">
  <div class="row swi">
    <div class="col s3 m3 it" data=".crZone" style="background: #1976D2; color: white;">
      Compte rendu<div class="right"><span class="ct"><?php echo $cr->rowCount(); ?></span></div>
    </div>
    <div class="col s4 m4 it" data=".txtZone">
      Textes de loi<div class="right"><span class="ct">0</span></div>
    </div>
    <div class="col s3 m3 it" data=".rapZone">
      Rapports<div class="right"><span class="ct">0</span></div>
    </div>
    <div class="col s1 m1"><button class="btn-floating grey darken-3 waves-effect waves-light backSearch"><i class="material-icons left">arrow_back</i></button></div>
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
            echo '<h4>Aucun résultat</h4>
            <font>Aucune référence précise pour <b class="findIt">'.htmlspecialchars($_POST['search']).'</b></font><br />
            <font class="orange-text flow-text">Voulez-vous essayer une recherche partielle? </font><a class="btn orange darken-2 waves-effect btnPartial">Essayer</a>';
          }
        ?>
      </div>
      <div class="col s12 m12 txtZone" style="display: none;"><h4>Inactif</h4></div>
      <div class="col s12 m12 rapZone" style="display: none;"><h4>Inactif</h4></div>
    </div>
    <div class="row loadAir"><center><img src="fonts/loader.gif" style="height: 70px; width: 80px; display: none;" /></center></div>
</div>

<style>.it{cursor: pointer;}
  .ct{border-radius:10px; text-align: center; /*padding-left: 10px; padding-right: 10px;*/padding: 3px 14px 3px 14px; font-size: 16px; border: solid .5px #ccc;}
  .swi div{line-height: 40px; /*text-align: center;*/}
  .swi{margin: 0px; border-bottom: solid 2px #1976D2;}
  .resultItem{line-height: 40px; margin-top: 5px; cursor: pointer; border-bottom: solid 1px #333;}
  .resultItem:hover{/*border-left: solid 5px rgb(80, 0, 117); transition-duration: .2s;*/ background: #ccc; transition-duration: .2s;}
  .resultItem .artTitle{color: #333; font-size: 15px;}
  .resultItem .dateA{color: rgb(0, 144, 226); font-size: 18px;}
</style>
<script type="text/javascript">
  $('.btnPartial').click(function(){
    $('.loadAir').show();
    $.post(
      'php/refineSearch.php',
      {
        option: 'conseil',
        text: $('.findIt').html()
      },
      function(data){
        $('.crZone').html(data);
      }
    );
    $('.loadAir').hide();
  });

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
      $('.it').css({'background':'none','color': 'black'});
      $(this).css({'background':'#1976D2','color': 'white'});
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
