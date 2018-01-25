<?php
  include_once('connectdb.php');
  session_start();
  switch(htmlspecialchars($_POST['opt'])){
    case 'mod':
      $r = $bdd->query('SELECT MAX(ID) as m FROM conseil');
      $d = $r->fetch();
      echo '<input type="hidden" class="curPage" value="'.htmlspecialchars($_POST['page']).'" />';
      $p = htmlspecialchars($_POST['page']);// * 12;
      $req=$bdd->prepare('SELECT c.ID, c.title, c.datea FROM conseil c, article a WHERE c.ID=a.Id AND (c.ID BETWEEN ? AND ?) ORDER BY c.ID DESC LIMIT 0,6');
      $req->execute(array($d['m']-($p*6), $d['m']-(($p-1)*6)));

      while($data = $req->fetch()){
        if(strlen($data['title'])>62){$data['title']=substr($data['title'], 0, 62).'..';}
        $cn=$bdd->prepare('SELECT COUNT(*) as n FROM comment WHERE article=?');
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
  case 'loip':
    $r = $bdd->query('SELECT MAX(ID) as m FROM loi');
    $d = $r->fetch();
    echo '<input type="hidden" class="curPage" value="'.htmlspecialchars($_POST['page']).'" />';
    $p = htmlspecialchars($_POST['page']);// * 12;
    $req=$bdd->prepare('SELECT ID, title, filelink FROM loi WHERE (ID BETWEEN ? AND ?) ORDER BY ID DESC LIMIT 0,6');
    $req->execute(array($d['m']-($p*6), $d['m']-(($p-1)*6)));

    while($data = $req->fetch()){
      //if(strlen($data['title'])>96){$data['title']=substr($data['title'], 0, 94).'..';}
      //$cn=$bdd->prepare('SELECT COUNT(*) as n FROM comment WHERE article=?');
      //$cn->execute(array($data['ID']));
      //$dn=$cn->fetch();
      echo '<div class="col s12 m6 l6"><div class="col m12 loiArt">
        <input type="hidden" class="onearticle" value="'.$data['ID'].'" />
        <div class="col m12 titlearticle2">'.$data['title'].'</div>
        <div class="col m12 footarticle">
          <a class="btn waves-effect grey darken-3 waves-light" type="application/pdf" href="'.$data['filelink'].'"><i class="material-icons left">file_download</i>Télécharger</a>
        </div>
      </div>
    </div>';
    }
    break;
  case 'rapportp':
    $r = $bdd->query('SELECT MAX(ID) as m FROM rapport');
    $d = $r->fetch();
    echo '<input type="hidden" class="curPage" value="'.htmlspecialchars($_POST['page']).'" />';
    $p = htmlspecialchars($_POST['page']);// * 12;
    $req=$bdd->prepare('SELECT ID, title, filelink FROM rapport WHERE (ID BETWEEN ? AND ?) ORDER BY ID DESC LIMIT 0,6');
    $req->execute(array($d['m']-($p*6), $d['m']-(($p-1)*6)));

    while($data = $req->fetch()){
      if(strlen($data['title'])>96){$data['title']=substr($data['title'], 0, 60).'..';}
      $data['filelink']='www.planificationfamiliale-burkinafaso.net/'.$data['filelink'];
      echo '<div class="col s12 m6 l6"><div class="col m12 loiArt z-depth-2" style="height: 125px;">
          <input type="hidden" class="onearticle" value="'.$data['ID'].'" />
          <div class="col m12 titlearticle">'.$data['title'].'</div>
          <div class="col m12 footarticle">
            <a class="btn waves-effect grey darken-3 waves-light" type="application/pdf" href="'.$data['filelink'].'"><i class="material-icons left">file_download</i>Télécharger</a>
          </div>
        </div>
      </div>';
      }
    break;
  }
?>
