<?php
  include_once('connectdb.php');
  session_start();
  switch(htmlspecialchars($_POST['opt'])){
    case 'mod':
      $r = $bdd->query('SELECT MAX(ID) as m FROM conseil');
      $d = $r->fetch();
      echo '<input type="hidden" class="curPage" value="'.htmlspecialchars($_POST['page']).'" />';
      $p = htmlspecialchars($_POST['page']);// * 12;
      $req=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE (ID BETWEEN ? AND ?) ORDER BY ID DESC LIMIT 0,12');
      $req->execute(array($d['m']-($p*12), $d['m']-(($p-1)*12)));

      while($data = $req->fetch()){
        if(strlen($data['title'])>62){$data['title']=substr($data['title'], 0, 62).'..';}
        $cn=$bdd->prepare('SELECT COUNT(*) as n FROM comment WHERE article=?');
        $cn->execute(array($data['ID']));
        $dn=$cn->fetch();
        echo '<div class="col m6 l4"><div class="col m12 article">
            <input type="hidden" class="onearticle" value="'.$data['ID'].'" />
            <div class="col m12 titlearticle">'.$data['title'].'</div>
            <div class="col m12 footarticle"><font class="col m7 datea">'.$data['datea'].'</font><font class="col m5 nbcom">Commentaires: '.$dn['n'].'</font></div>
            </div>
        </div>';

    }
  ?>
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
    </script>
    <?php
    break;
  /*case 'page':
      $p = new Paginator();
      $p->cat='cr-cm';
      $p->page=htmlspecialchars($_POST['page']);
      echo $p->page($bdd);
    break;
  case 'lastPage':
      $p = new Paginator();
      $p->cat='cr-cm';
      echo $p->lastPage($bdd);
    break;*/
  }
?>
