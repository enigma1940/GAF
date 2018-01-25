<script type="text/javascript">
    $('.resultItem').click(function(){
        $('.resultArea').hide();
        $('.resultOpen').html('<img src="images/loader.gif" style="margin-left:15px; margin-top:5px;" />'); $('.resultOpen').show();
        $.post(
          'php/openArticle.php',
          {opt: 'openResult', type: $(this).parent().children('.choice').val(), result: $(this).children('.aid').val()},
          function(data){$('.resultOpen').html(data);}
        );
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

<?php
  include_once('connectdb.php');
  function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
  }
  $result;
  spl_autoload_register('my_autoloader');
  switch (htmlspecialchars($_POST['opt'])) {
    case 'yearSearchText':
        $search = new Search();
        $search->setText(htmlspecialchars($_POST['text']));
        $search->setAnnee(htmlspecialchars($_POST['year']));
        $result = $search->searchTextYear($bdd);
        /*
        0- Deliberations
        1- Nominations
        2- Communications
        3- Content (Autres)
        */
      break;
    case 'monthYearText':
      $search = new Search();
      $search->setText(htmlspecialchars($_POST['text']));
      $search->setAnnee(htmlspecialchars($_POST['year']));
      $search->setMois(htmlspecialchars($_POST['mois']));
      $result = $search->searchTextMonthYear($bdd);
      break;
  }
?>

<div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 resultArea" style="margin-top:20px;">
<fieldset>
    <legend>
        <div class="col-xs-12 col-sm-20 col-md-20 col-lg-20">
            Résultats <span style="font-size:12px;">Cliquer sur les différents liens pour accéder aux résultats</span>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" align="right"><button class="btn  btn-success backSearch" style="margin-top:1%;">Retour</button></div>
    </legend>
          <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 typeC" data="delibArea" style="background:white;">Délibérations <span class="ctCat right"><?php echo $result[0]->rowCount(); ?></span></div>
          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 typeC" data="comArea">Communications orales <span class="ctCat right"><?php echo $result[1]->rowCount(); ?></span></div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 typeC" data="nomArea">Nominations <span class="ctCat right"><?php echo $result[2]->rowCount(); ?></span></div>
          <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6 typeC" data="autreArea">Autres <span class="ctCat right"><?php echo $result[3]->rowCount(); ?></span></div>
          </div>
          <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 resultFound">
            <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 zone delibArea">
              <input type="hidden" class="choice" value="delib" />
              <?php if($result[0]->rowCount()>0){
              while($data=$result[0]->fetch()){
                echo '<div class="col m8 resultItem">
                  <font class="col m8 artTitle">'.$data['title'].'</font>
                  <font class="col m4 dateA" style="float:right;">'.$data['datea'].'</font>
                  <input type="hidden" class="aid" value="'.$data['ID'].'" />
                  </div>';}
                }else{
                  echo '<h4>Aucun résultat</h4>';
                } ?>
            </div>
            <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 zone comArea" style="display: none;">
              <input type="hidden" class="choice" value="com" />
              <?php if($result[1]->rowCount()>0){
              while($data=$result[1]->fetch()){
                echo '<div class="col-lg-22 resultItem">
                  <font class="col-lg-18 artTitle">'.$data['title'].'</font>
                  <font class="col-lg-4 dateA" style="float:right;">'.$data['datea'].'</font>
                  <input type="hidden" class="aid" value="'.$data['ID'].'" />
                  </div>';}
                }else{
                  echo '<h4>Aucun résultat</h4>';
                } ?>
            </div>
            <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 zone nomArea" style="display: none;">
              <input type="hidden" class="choice" value="nom" />
              <?php if($result[2]->rowCount()>0){
              while($data=$result[2]->fetch()){
                echo '<div class="col-lg-22 resultItem">
                  <font class="col-lg-18 artTitle">'.$data['title'].'</font>
                  <font class="col-lg-4 dateA" style="float:right;">'.$data['datea'].'</font>
                  <input type="hidden" class="aid" value="'.$data['ID'].'" />
                  </div>';}
                }else{
                  echo '<h4>Aucun résultat</h4>';
                } ?>
            </div>
            <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 zone autreArea" style="display: none;">
              <input type="hidden" class="choice" value="autre" />
              <?php if($result[3]->rowCount()>0){
              while($data=$result[3]->fetch()){
                echo '<div class="col-lg-22 resultItem">
                  <font class="col-lg-18 artTitle">'.$data['title'].'</font>
                  <font class="col-lg-4 dateA" style="float:right;">'.$data['datea'].'</font>
                  <input type="hidden" class="aid" value="'.$data['ID'].'" />
                  </div>';}
                }else{
                  echo '<h4>Aucun résultat</h4>';
                } ?>
            </div>
          </div>
</fieldset>
</div>
<div class="resultOpen row" style="display: none;"></div>
<script type="text/javascript">
  $('.typeC').click(function(){
    $('.typeC').css('background', '#ccc');
    $(this).css('background','#fff');
    $('.zone').hide();
    $('.'+$(this).attr('data')).toggle('fade');
  });
</script>
<style>
  /*.zone{background: #ccc;}*/
  .typeC{background: #ccc; line-height: 40px; text-align: center; cursor: pointer; border-bottom: solid 1px #ccc;}
  .resultItem{line-height: 40px; margin-top: 5px; cursor: pointer; border-bottom: solid 1px #333;}
  .resultItem:hover{border-left: solid 5px #666666; padding-left: 1%; transition-duration: .2s;}
  .resultItem .artTitle{color: #333; font-size: 14px;}
  .resultItem .dateA{color: rgb(0, 144, 226); font-size: 16px;}
</style>
