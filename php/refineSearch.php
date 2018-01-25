<?php
  include_once('connectdb.php');

  switch ($_POST['option']) {
    case 'conseil':
        $cr=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE (title LIKE :title) OR (content LIKE :title) OR (deliberation LIKE :title) OR (nomination LIKE :title) OR (communication LIKE :title) ORDER BY ID DESC');
        $cr->execute(array(
          ':title'=>'%'.str_replace(' ', '%', htmlspecialchars($_POST['text'])).'%'
        ));
        $cr->execute();
        if($cr->rowCount()==0){
          $cr=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE (title REGEXP :title) OR (content REGEXP :title) OR (deliberation REGEXP :title) OR (nomination REGEXP :title) OR (communication REGEXP :title) ORDER BY ID DESC');
          $cr->execute(array(
            ':title'=>str_replace(' ', '|', htmlspecialchars($_POST['text']))
          ));
        }

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
      break;

    default:
      # code...
      break;
  }

?>
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
</script>
