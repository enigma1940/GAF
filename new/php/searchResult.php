<script type="text/javascript">
    $('.resultItem').click(function(){
    $('.searchResult').css('display','none');
    $('.a').show();
    $.ajax({
      type: "POST",
      url: 'php/openArticle.php',
      data: '&opt=openSArticle&art='+$(this).children('.aid').val(),
      beforeSend: function(){/*$('.general').html('<img src="fonts/loader.gif" />');*/ $('.a').html('<img src="images/loader.gif" />'); },
      success: function(data){ $('.a').html(data); }
    });
  });
</script>

<?php
  include_once('connectdb.php');

  // Comptes rendus des conseils de ministres
  $cr;
  $cr=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE (title LIKE :title) OR (content LIKE :title) OR (deliberation LIKE :title) OR (nomination LIKE :title) OR (communication LIKE :title) ORDER BY ID DESC');
  $cr->execute(array(
    ':title'=>'%'.str_replace(' ', '%', htmlspecialchars($_POST['search'])).'%'
  ));
  $cr->execute();
  if($cr->rowCount()==0){
    $cr=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE (title REGEXP :title) OR (content REGEXP :title) OR (deliberation REGEXP :title) OR (nomination REGEXP :title) OR (communication REGEXP :title) ORDER BY ID DESC');
    $cr->execute(array(
      ':title'=>str_replace(' ', '|', htmlspecialchars($_POST['search']))
    ));
  }

  // Textes de lois
  $txt;
  $txt=$bdd->prepare('SELECT ID, title, filelink FROM loi WHERE (title LIKE :title) OR (filelink LIKE :title) OR (link LIKE :title) ORDER BY ID DESC');
  $txt->execute(array(
    ':title'=>'%'.str_replace(' ', '%', htmlspecialchars($_POST['search'])).'%'
  ));
  $txt->execute();
  if($txt->rowCount()==0){
    $txt=$bdd->prepare('SELECT ID, title, filelink FROM loi WHERE (title REGEXP :title) OR (filelink REGEXP :title) OR (link REGEXP :title) ORDER BY ID DESC');
    $txt->execute(array(
      ':title'=>str_replace(' ', '|', htmlspecialchars($_POST['search']))
    ));
  }

  // Rapports des institutions publiques
  $rap;
  $rap=$bdd->prepare('SELECT ID, title, filelink FROM rapport WHERE (title LIKE :title) OR (filelink LIKE :title) OR (link LIKE :title) ORDER BY ID DESC');
  $rap->execute(array(
    ':title'=>'%'.str_replace(' ', '%', htmlspecialchars($_POST['search'])).'%'
  ));
  $rap->execute();
  if($rap->rowCount()==0){
    $rap=$bdd->prepare('SELECT ID, title, filelink FROM rapport WHERE (title REGEXP :title) OR (filelink REGEXP :title) OR (link REGEXP :title) ORDER BY ID DESC');
    $rap->execute(array(
      ':title'=>str_replace(' ', '|', htmlspecialchars($_POST['search']))
    ));
  }
?>
<div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-top:20px;">
<fieldset>
    <legend>Résultats <span style="font-size:12px;">Cliquer sur les différents liens pour accéder aux résultats</span></legend>
  <div class="row swi">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 it" data=".crZone" style="background:#ccc;">
      Compte rendu du conseil des ministres
      <div style="float: right;"><font style="background:#666666; color:#fff;" class="ct"><?php echo $cr->rowCount(); ?></font></div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 it" data=".txtZone" style="background:#666666; color: white; border-left: solid 1px #ccc; border-right: solid 1px #ccc;">
      Textes de loi
      <div style="float: right;"><font style="background:#666666; color:#fff;" class="ct"><?php echo $txt->rowCount(); ?></font></div>
    </div>
    <div class="col-xs-12 col-sm-24 col-md-8 col-lg-8 it" data=".rapZone" style="background:#666666; color: white;">
      Rapport des institutions publiques
      <div style="float: right;"><font style="background:#666666; color:#fff;" class="ct"><?php echo $rap->rowCount(); ?></font></div>
    </div>
    <div class="col-xs-12 col-sm-24 col-md-2 col-lg-2"><button class="btn  btn-success backSearch" style="margin-top:1%;">Retour</button></div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 crZone">
      <?php
        if($cr->rowCount()>0){
        while($data=$cr->fetch()){
          echo '<div class="col-lg-22 resultItem">
            <font class="col-lg-18 artTitle">'.$data['title'].'</font>
            <font class="col-lg-4 dateA" style="float:right;">'.$data['datea'].'</font>
            <input type="hidden" class="aid" value="'.$data['ID'].'" />
            </div>';}
          }else{
            echo '<h4>Aucun résultat</h4>';
          }
        ?>
      </div>
      <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 txtZone" style="display: none;">
        <?php
        if($txt->rowCount()>0){
        while($dataa=$txt->fetch()){
          echo '<div class="col-lg-22 txt-lois">
            <font class="col-lg-18 artTitle"><a href="'.$dataa['filelink'].'" target="_blank">'.$dataa['title'].'</a></font>
            </div>';}
          }else{
            echo '<h4>Aucun résultat</h4>';
          }
        ?>
      </div>
      <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 rapZone" style="display: none;">
        <?php
        if($rap->rowCount()>0){
        while($dat=$rap->fetch()){
          echo '<div class="col-lg-22 rap">
            <font class="col-lg-18 artTitle"><a href="http://www.planificationfamiliale-burkinafaso.net/'.$dat['filelink'].'" target="_blank">'.$dat['title'].'</a></font>
            </div>';}
          }else{
            echo '<h4>Aucun résultat</h4>';
          }
        ?>
      </div>
    </div>
</fieldset>
</div>

<style>.it{cursor: pointer;}
  .ct{border-radius:5px; text-align: center; /*padding-left: 10px; padding-right: 10px;*/padding: 3px 14px 3px 14px; font-size: 16px; border: solid .5px #ccc;}
  .swi div{line-height: 30px; font-size: 15px; /*text-align: center;*/}
  .swi{margin: 0px;}
  .resultItem{line-height: 40px; margin-top: 5px; cursor: pointer; border-bottom: solid 1px #333;}
  .resultItem:hover{border-left: solid 5px #666666; transition-duration: .2s;}
  .resultItem .artTitle{color: #333; font-size: 14px;}
  .resultItem .dateA{color: rgb(0, 144, 226); font-size: 16px;}
  
  .txt-lois{line-height: 40px; margin-top: 5px; cursor: pointer; border-bottom: solid 1px #333;}
  .txt-lois:hover{border-left: solid 5px #666666; transition-duration: .2s;}
  .txt-lois {font-size: 13px;}
    
  .rap{line-height: 40px; margin-top: 5px; cursor: pointer; border-bottom: solid 1px #333;}
  .rap:hover{border-left: solid 5px #666666; transition-duration: .2s;}
  .rap {font-size: 14px;}
</style>
<script type="text/javascript">

  function clearZone(){
    $('.crZone').css('display','none');
    $('.txtZone').css('display','none');
    $('.rapZone').css('display','none');
  }
  $('.it').click(function(){
      clearZone();
      $('.it').css({'background':'#666666','color': 'white'});
      $(this).css({'background':'#ccc','color': 'black'});
      $($(this).attr('data')).toggle('drop');
  });
  $('.backSearch').click(function(){
    $('.searchResult').css('display', 'none');
    $('.Bienvenue').css('display', 'block');
    $('.Recherche').css('display', 'block');
    $('.Categories').css('display', 'block');
    $('.Nouvelles').css('display', 'block');
    $('.Articles').css('display', 'block');
    $('#RechA').css('display', 'none');
    $('.Lois').css('display','none');
    $('.Rapports').css('display','none');
    /*$.post(
      'php/openArticle.php',
      {opt:'last'},
      function(data){$('.lastArticle').html(data);}
    );*/
  });
</script>
