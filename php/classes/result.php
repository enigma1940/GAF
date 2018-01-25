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
      $result = $search->searchTextMonthYear();

      default:
      # code...
      break;
  }
?>
<div class="row" style="border-bottom: solid 1px #ccc;">
  <div class="col m3 typeC" data="delibArea">Délibérations<span class="ctCat right"><?php echo $result[0]->rowCount(); ?></span></div>
  <div class="col m3 typeC" data="comArea">Communications orales<span class="ctCat right"><?php echo $result[1]->rowCount(); ?></span></div>
  <div class="col m3 typeC" data="nomArea">Nominations<span class="ctCat right"><?php echo $result[2]->rowCount(); ?></span></div>
  <div class="col m3 typeC" data="autreArea">Autres<span class="ctCat right"><?php echo $result[3]->rowCount(); ?></span></div>
  <div class="col m12 resultFound">
    <div class="col m12 zone delibArea">
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
    <div class="col m12 zone comArea" style="display: none;">
      <?php if($result[1]->rowCount()>0){
      while($data=$result[1]->fetch()){
        echo '<div class="col m8 resultItem">
          <font class="col m8 artTitle">'.$data['title'].'</font>
          <font class="col m4 dateA" style="float:right;">'.$data['datea'].'</font>
          <input type="hidden" class="aid" value="'.$data['ID'].'" />
          </div>';}
        }else{
          echo '<h4>Aucun résultat</h4>';
        } ?>
    </div>
    <div class="col m12 zone nomArea" style="display: none;">
      <?php if($result[2]->rowCount()>0){
      while($data=$result[2]->fetch()){
        echo '<div class="col m8 resultItem">
          <font class="col m8 artTitle">'.$data['title'].'</font>
          <font class="col m4 dateA" style="float:right;">'.$data['datea'].'</font>
          <input type="hidden" class="aid" value="'.$data['ID'].'" />
          </div>';}
        }else{
          echo '<h4>Aucun résultat</h4>';
        } ?>
    </div>
    <div class="col m12 zone autreArea" style="display: none;">
      <?php if($result[3]->rowCount()>0){
      while($data=$result[3]->fetch()){
        echo '<div class="col m8 resultItem">
          <font class="col m8 artTitle">'.$data['title'].'</font>
          <font class="col m4 dateA" style="float:right;">'.$data['datea'].'</font>
          <input type="hidden" class="aid" value="'.$data['ID'].'" />
          </div>';}
        }else{
          echo '<h4>Aucun résultat</h4>';
        } ?>
    </div>
  </div>
</div>
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
  .resultItem:hover{border-left: solid 5px rgb(80, 0, 117); transition-duration: .2s;}
  .resultItem .artTitle{color: #333; font-size: 15px;}
  .resultItem .dateA{color: rgb(0, 144, 226); font-size: 18px;}
</style>
