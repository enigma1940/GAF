<script type="text/javascript">
    
 // Retour à la page d'accueil
  $('.btnBackSearchh').click(function(){
      $('.Art').hide();
      $('.Bienvenue').css('display', 'block');
      $('.Recherche').css('display', 'block');
      $('.Categories').css('display', 'block');
      $('.Nouvelles').css('display', 'block');
      $('.Articles').css('display', 'block');
      $('#RechA').css('display', 'none');
      $('.Lois').css('display','none');
      $('.Rapports').css('display','none');
    });
    
    
    // Retour à la liste des resultats
    $('.btnBackSearch').click(function(){
          $('.a').hide();
           $('.Recherche').css('display', 'block');
           $('.searchResult').css('display', 'block');;
           $('#RechA').css('display', 'none');
           $('.Lois').css('display','none');
           $('.Rapports').css('display','none');
        });
    
    // Cacher ou afficher le texte
    $('ContentArticle').css('display', 'block');
    $('.TitleArticle').click(function(){
      if($($(this).attr('data')).css('display')=='none') $($(this).attr('data')).show('slow');
      else $($(this).attr('data')).hide('slow');
    });
    
    // Sroll pour la repartition du texte (Deliberations - Communications Orales - Nominations)
    $('.jsscroll').on('click', function() {
      try{
        var page = $(this).attr('href');
        var speed = 500;
        $('html, body').animate( { scrollTop: $(page).offset().top-$('.controlArea').height() }, speed ); // Go
          return false;
      }catch(err){
        return false;
      }
    });
    
    // Recherche interne    
    
    $('.innerSearch').submit(function(e){
        e.preventDefault();      
        if($('.inSearch').val()){
        $('.texte').removeHighlight().highlight($('.inSearch').val());
        $('html, body').animate({ scrollTop: $('.highlight:visible:first').offset().top -$('.controlArea').height() }, 500);}
    });
    
    
    // Mise en surbrillance
    jQuery.fn.highlight=function(c){function e(b,c){var d=0;if(3==b.nodeType){var a=b.data.toUpperCase().indexOf(c),a=a-(b.data.substr(0,a).toUpperCase().length-b.data.substr(0,a).length);if(0<=a){d=document.createElement("span");d.className="highlight";a=b.splitText(a);a.splitText(c.length);var f=a.cloneNode(!0);d.appendChild(f);a.parentNode.replaceChild(d,a);d=1}}else if(1==b.nodeType&&b.childNodes&&!/(script|style)/i.test(b.tagName))for(a=0;a<b.childNodes.length;++a)a+=e(b.childNodes[a],c);return d} return this.length&&c&&c.length?this.each(function(){e(this,c.toUpperCase())}):this};jQuery.fn.removeHighlight=function(){return this.find("span.highlight").each(function(){this.parentNode.firstChild.nodeName;with(this.parentNode)replaceChild(this.firstChild,this),normalize()}).end()};
    
    // Mise en surbrillance automatique via la recherche générale.
    if($('.searchText').val()){
    $('.texte').removeHighlight().highlight($('.searchText').val());
        $('html, body').animate({
          scrollTop: $('.highlight:visible:first').offset().top-$('.controlArea').height()
        }, 500);
    };
    if($('.searchBar').val()){
    $('.texte').removeHighlight().highlight($('.searchBar').val());
        $('html, body').animate({
          scrollTop: $('.highlight:visible:first').offset().top-$('.controlArea').height()
        }, 500);
    };
    
    // Commentaires
    $('.showCommentCom').click(function(){
            $('.popup').css('display','block');
            $('.sendComment').css('display','block');
          });
    
    $('.btnClose').click(function(){
        $('.sendComment').toggle('drop');
        $('.popup').css('display', 'none');
      });
    
    // Continuer la lecture
    $('.contRead').click(function(){
      $('ContentArticle').hide();
      $('.Conseil').css('display', 'block');
      $('.Lois').css('display', 'none');
      $('.Rapports').css('display','none');
    });
    
    // Commentaires
    $('.postCommentForm').submit(function(e){
    e.preventDefault();
    $('.errComment').css('display', 'none');
    if($('.commentUname').val()!="" && $('.commentText').val()!=""){
        
      $.post(        
        'php/openArticle.php',
        {
          opt:'sendComment',
          uname: $('.commentUname').val(),
          content: $('.commentText').val(),
          article: $('.tt').attr('data'),
          mail: $('.mailComment').val()
        },
        function(data){
          //alert(data);
        }
      );
        
      $('.showComments').click(function(){
        $('.thecomments').html('<img src="images/loader.gif" />');
        $('.thecomments').toggle('drop');
        $.post(
          'php/openArticle.php',
          {opt: 'showComment', article: $('.tt').attr('data')},
          function(data){
            $('.thecomments').html(data);
          }
        );
      });
        
      $('.sendComment').toggle('drop');
      $('.popup').css('display', 'none');
     /* $('.postCommentForm')[0].reset();  */
    }else{
      $('.errComment').toggle('drop');
    }
    $('.commentUname').val(''); $('.commentText').val('');
  });
    
  // Voir les commentaires
  $('.showComments').click(function(){
      $('.thecomments').html('<img src="images/loader.gif" />');
      $('.thecomments').css('display', 'block');
      $('.texte').hide();
      $.post(
        'php/openArticle.php',
        {opt: 'showComment', article: $('.tt').attr('data')},
        function(data){
          $('.thecomments').html(data);
        }
      );
    });
    
    $('.goBack').click(function(){
          $('.resultOpen').hide();
          $('.resultOpen').html('');
          $('.resultArea').toggle('fade');
        });
    
     // Fixer le menu interne - résultats articles
    /*
    var h = parseFloat($('header').height())+parseFloat($('.sssc').height());
    alert(h);
    $(document).scroll(function(){
    if ($(window).scrollTop() >= parseFloat($('header').height())+parseFloat($('.sssc').height())) {
        $('.controlArea').css({'position': 'fixed', 'top':'0'});
      } else {
        $('.controlArea').css({'position': 'static', 'top':'0'});
      }
    });
    $('.toggle-visibility').click(function(){
      if($(this).attr('class')=='col-xs-12 col-sm-24 col-md-24 col-lg-24 toggle-visibility'){
        $(this).attr('class', 'col-xs-12 col-sm-24 col-md-24 col-lg-24 toggle-visibility sticky-top');
        $($(this).attr('data-target')).show('slow');
      }else{
        $(this).attr('class', 'col-xs-12 col-sm-24 col-md-24 col-lg-24 toggle-visibility');
        $($(this).attr('data-target')).hide('slow'); 
      } 
      */
    
</script>


<?php
  include_once('connectdb.php');
  function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
  }
  spl_autoload_register('my_autoloader');

  switch(htmlspecialchars($_POST['opt'])){
    case 'openArticle':
        $ar = new Article();
        $ar->setId(htmlspecialchars($_POST['art']));
        $ar->read($bdd);
        echo '<div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-top:20px;"><fieldset><legend style="font-size:18px;">Résultat de la sélection</legend></fieldet></div>
              <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 controlArea" style="margin-bottom: 0px;">
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <button class="btn btn-success btnBackSearchh">Retour</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 links">
                    <a class="col-xs-6 col-sm-8 col-md-8 col-lg-8 jsscroll" href="#venirA" style="text-align:center;">Deliberations</a>
                    <a class="col-xs-6 col-sm-8 col-md-8 col-lg-8 jsscroll" href="#venirB">Communications orales</a>
                    <a class="col-xs-6 col-sm-8 col-md-8 col-lg-8 jsscroll" href="#venirC" style="text-align:center;">Nominations</a>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                  <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="color:red; font-size:11px;">Cliquez forcément sur le bouton "search" pour lancer la recherche</div>
                  <form class="innerSearch">
                    <div class="input-field col-xs-8 col-sm-18 col-md-18 col-lg-18" style="margin: 0px; padding: 0px;">
                        <input type="text" placeholder="Rechercher dans le texte" class="form-control left-rounded inSearch" />
                    </div>
                    <div class="input-field col-xs-2 col-sm-2 col-md-2 col-lg-2" style="margin: 0px; padding: 0px;">
                        <button type="submit" class="btn btn-success">search</button>
                    </div>
                  </form>
                </div>
              </div>
          <div class="tt" data="'.$ar->getId().'">
            <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 toggle-visibility sticky-top titleA" data-target="#textComplete">
              <h3 style="background: #fff; padding: 8px; cursor: pointer;" class="TitleArticle" data="ContentArticle">'.$ar->getTitle().'<span style="font-size: 12px; color: #333;">  ( Cliquer pour lire ou replier) </span>
              </h3>
            </div>
            <ContentArticle><div class="col-sm-1 col-md-1 col-lg-1"></div><div class="col-xs-12 col-sm-22 col-md-22 col-lg-22 texte" id="textComplete" align="justify">'.$ar->getContent().'<div id="venirA"></div>'.$ar->getDeliberation().'<div id="venirB"></div>'.$ar->getCommunication().'<div id="venirC"></div>'.$ar->getNomination().'</div><div class="col-sm-1 col-md-1 col-lg-1"></div></ContentArticle>
          </div>'; ?>
          
          <div class="commentArea col-xs-12 col-sm-24 col-md-24 col-lg-24">
            <div class="col-sm-1 col-md-1 col-lg-1"></div>
            <div class="commentArea col-xs-12 col-sm-22 col-md-22 col-lg-22">
            <button class="btn btn-success showComments" style="margin-top:1%;"><i class="icon icon-eye"></i>&nbsp;Voir les commentaires</button>
            <button class="btn btn-primary showCommentCom" style="margin-top:1%;"><i class="icon icon-file-text-o"></i>&nbsp;Commenter</button>
            <button class="btn btn-purple contRead" style="margin-top:1%;"><i class="icon icon-long-arrow-right"></i>&nbsp;Continuer la lecture</button>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1"></div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 thecomments"></div>
          <div class="popup">
            <div class="row commentZone">
                <div class="col-xs-1 col-sm-6 col-md-6 col-lg-6"></div>
              <div class="col-xs-10 col-sm-12 col-md-12 col-lg-12 sendComment" style="display: none;">
                <form class="postCommentForm col-xs-12 col-sm-24 col-md-24 col-lg-24 white">
                  <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 commenttitle" style="margin-top:1%;"><i class="icon icon-long-arrow-left"></i>&nbsp;Laisser un commentaire&nbsp;<i class="icon icon-long-arrow-right"></i></div>
                  <div class="input-field col-xs-12 col-sm-24 col-md-24 col-lg-24">
                    <input type="text" class="form-control commentUname" placeholder="Entrer un identifiant, pseudo" />
                  </div>
                  <div class="input-field col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-top:1%;">
                    <input type="email" class="form-control mailComment" placeholder="Entrer votre adresse mail" />
                  </div>
                  <div class="input-field col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-top:1%;">
                    <textarea class="form-control commentText" rows="3" placeholder="Entrer votre commentaire ici"></textarea>
                  </div>
                  <font class="col-xs-12 col-sm-24 col-md-24 col-lg-24 errComment" style="color: rgb(190, 0, 57); display: none; text-align:center; margin-top:1%;">Une erreur est survenue, veuillez à nouveau remplir les champs !</font>
                  <i class="icon icon-hand-o-right icon-lg" style="margin-top:1%;"></i>&nbsp;<input type="submit" class="btn btn-success" value="Poster" style="margin-top:1%;">
                  <button type="button" class="btn btn-purple btnClose" style="margin-top:1%;"><i class="icon icon-times"></i>&nbsp;Fermer</button>
                </form>
              </div>
                <div class="col-xs-1 col-sm-6 col-md-6 col-lg-6"></div>
            </div>
          </div>
          <style>
            .popup{position: fixed; height: 100%; width: 100%; background: rgba(0,0,0,0.7); z-index: auto; top: 0; left: 0; display: none;}
            .sendComment{background-color: white; padding-bottom: 5px; border-radius:10px;}
          </style>

  <?php
      break;
   case 'sendComment':
        $com = new Comment();
        $com->setUname(htmlspecialchars($_POST['uname']));
        $com->setContent(htmlspecialchars($_POST['content']));
        $com->setArticle(htmlspecialchars($_POST['article']));
        $com->setMail(htmlspecialchars($_POST['mail']));
        $com->create($bdd);
      break;

    case 'openSArticle':
    $ar = new Article();
    $ar->setId(htmlspecialchars($_POST['art']));
    $ar->read($bdd);
    echo '<div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-top:20px;"><fieldset><legend style="font-size:18px;">Résultat de la sélection</legend></fieldet></div>
              <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 controlArea" style="margin-bottom: 0px;">
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <button class="btn btn-success btnBackSearch">Retour</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 links">
                    <a class="col-xs-6 col-sm-8 col-md-8 col-lg-8 jsscroll" href="#venirA" style="text-align:center;">Deliberations</a>
                    <a class="col-xs-6 col-sm-8 col-md-8 col-lg-8 jsscroll" href="#venirB">Communications orales</a>
                    <a class="col-xs-6 col-sm-8 col-md-8 col-lg-8 jsscroll" href="#venirC" style="text-align:center;">Nominations</a>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                  <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="color:red; font-size:11px;">Cliquez forcément sur le bouton "search" pour lancer la recherche</div>
                  <form class="innerSearch">
                    <div class="input-field col-xs-8 col-sm-18 col-md-18 col-lg-18" style="margin: 0px; padding: 0px;">
                        <input type="text" placeholder="Rechercher dans le texte" class="form-control left-rounded inSearch" />
                    </div>
                    <div class="input-field col-xs-2 col-sm-2 col-md-2 col-lg-2" style="margin: 0px; padding: 0px;">
                        <button type="submit" class="btn btn-success">search</button>
                    </div>
                  </form>
                </div>
              </div>
          <div class="tt" data="'.$ar->getId().'">
            <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 toggle-visibility sticky-top titleA" data-target="#textComplete">
              <h3 style="background: #fff; padding: 8px; cursor: pointer;" class="TitleArticle" data="ContentArticle">'.$ar->getTitle().'<span style="font-size: 12px; color: #333;">  ( Cliquer pour lire ou replier) </span>
              </h3>
            </div>
            <ContentArticle><div class="col-sm-1 col-md-1 col-lg-1"></div><div class="col-xs-12 col-sm-22 col-md-22 col-lg-22 texte" id="textComplete" align="justify">'.$ar->getContent().'<div id="venirA"></div>'.$ar->getDeliberation().'<div id="venirB"></div>'.$ar->getCommunication().'<div id="venirC"></div>'.$ar->getNomination().'</div><div class="col-sm-1 col-md-1 col-lg-1"></div></ContentArticle>
          </div>'; ?>
      
      <div class="commentArea col-xs-12 col-sm-24 col-md-24 col-lg-24">
        <div class="col-sm-1 col-md-1 col-lg-1"></div>
        <div class="commentArea col-xs-12 col-sm-22 col-md-22 col-lg-22">
        <button class="btn btn-success showComments" style="margin-top:1%;"><i class="icon icon-eye"></i>&nbsp;Voir les commentaires</button>
        <button class="btn btn-primary showCommentCom" style="margin-top:1%;"><i class="icon icon-file-text"></i>&nbsp;Commenter</button>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-1"></div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 thecomments"></div>
      <div class="popup">
        <div class="row commentZone">
            <div class="col-xs-1 col-sm-6 col-md-6 col-lg-6"></div>
          <div class="col-xs-10 col-sm-12 col-md-12 col-lg-12 sendComment" style="display: none;">
            <form class="postCommentForm col-xs-12 col-sm-24 col-md-24 col-lg-24 white">
              <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 commenttitle" style="margin-top:1%;"><i class="icon icon-long-arrow-left"></i>&nbsp;Laisser un commentaire&nbsp;<i class="icon icon-long-arrow-right"></i></div>
              <div class="input-field col-xs-12 col-sm-24 col-md-24 col-lg-24">
                <input type="text" class="form-control commentUname" placeholder="Entrer un identifiant, pseudo" />
              </div>
              <div class="input-field col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-top:1%;">
                <input type="email" class="form-control mailComment" placeholder="Entrer votre adresse mail" />
              </div>
              <div class="input-field col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-top:1%;">
                <textarea class="form-control commentText" rows="3" placeholder="Entrer votre commentaire ici"></textarea>
              </div>
              <font class="col-xs-12 col-sm-24 col-md-24 col-lg-24 errComment" style="color: rgb(190, 0, 57); display: none; text-align:center; margin-top:1%;">Une erreur est survenue, veuillez à nouveau remplir les champs !</font>
              <i class="icon icon-hand-o-right icon-lg" style="margin-top:1%;"></i>&nbsp;<input type="submit" class="btn btn-success" value="Poster" style="margin-top:1%;">
              <button type="button" class="btn btn-purple btnClose" style="margin-top:1%;"><i class="icon icon-times"></i>&nbsp;Fermer</button>
            </form>
          </div>
            <div class="col-xs-1 col-sm-6 col-md-6 col-lg-6"></div>
        </div>
      </div>
      <style>
        .popup{position: fixed; height: 100%; width: 100%; background: rgba(0,0,0,0.7); z-index: auto; top: 0; left: 0; display: none;}
        .sendComment{background-color: white; padding-bottom: 5px; border-radius:10px;}
      </style>

    <?php
      break;
    case 'last':
        $a = new Article();
        $r = $bdd->query('SELECT MAX(ID) as m FROM article WHERE cat="cr-cm"');
        $d = $r->fetch();
        $a->setId($d['m']); $a->read($bdd);
        echo '<div class="col m10 offset-m1">
          <h4 class="titleA" data="#textComplete">'.$a->getTitle().'</h4>
          <div class="col m12" id="textComplete">'.$a->getContent().'</div>
        </div>';?>
        <script>
          $('.titleA').click(function(){
            if($($(this).attr('data')).css('display')=='none') $($(this).attr('data')).show('slow');
            else $($(this).attr('data')).hide('slow');
          });
        </script>

  <?php  break;
          
    case 'showComment':
        $r=$bdd->prepare('SELECT * FROM comment WHERE article=? ORDER BY ID DESC');
        $r->execute(array(htmlspecialchars($_POST['article'])));
        echo'<div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 col-lg-offset-12 col-md-offset-12 col-sm-offset-12" style="margin-top:30px;"><fieldset><legend style="font-size:18px;">Les commentaires</legend>';
        while($d=$r->fetch()){
          echo '<div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-bottom:20px;">
                    <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="background-color:rgb(0, 150, 136); color: white;"><div class="col-xs-6 col-sm-12 col-md-12 col-lg-12" align="left">'.$d['uname'].'</div><div class="col-xs-6 col-sm-12 col-md-12 col-lg-12" align="right">'.$d['datec'].'</div></div>
                    <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="border: solid 1px rgb(0, 150, 136);">'.$d['content'].'</div>
                </div>';
        }
        echo '</fieldet></div>';
      break;
          
    case 'openResult':
      $type;
      switch(htmlspecialchars($_POST['type'])){
        case 'delib': $type='deliberation'; break;
        case 'nom': $type='nomination'; break;
        case 'com': $type='communication'; break;
        case 'autre'; $type='content'; break;
      }
      $req=$bdd->prepare('SELECT title, '.$type.' FROM conseil WHERE ID=:id');
      $req->execute(array(
        //':type'=>$type,
        ':id'=>htmlspecialchars($_POST['result'])
      ));

      $data3=$req->fetch(); ?>
      <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-top:20px;">
          <fieldset class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
              <legend style="font-size:18px;">Résultat de la sélection</legend>
              <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <button class="btn btn-success goBack">Retour</button>
                </div>
                <div class="col-xs-12 col-sm-22 col-md-22 col-lg-22">
                <div class="col-sm-6 col-md-6 col-lg-6"></div>
                <form class="col-xs-12 col-sm-16 col-md-16 col-lg-16 innerSearch">
                    <div class="input-field col-xs-8 col-sm-18 col-md-18 col-lg-18" style="margin: 0px; padding: 0px;">
                        <input type="text" placeholder="Rechercher dans le texte" class="form-control left-rounded inSearch" />
                    </div>
                    <div class="input-field col-xs-2 col-sm-2 col-md-2 col-lg-2" style="margin: 0px; padding: 0px;">
                        <button type="submit" class="btn btn-success">search</button>
                    </div>
                </form>
                </div>
              </div>
              <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
                  <h3 class="TitleArticle titleA" data="ContentArticle"><?php echo $data3['title']; ?></h3>
              </div>
              <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" id="textComplete" style="text-align:justify;">
                  <ContentArticle>
                  <div class="col-sm-1 col-md-1 col-lg-1"></div>
                  <div class="col-xs-12 col-sm-22 col-md-22 col-lg-22 texte">
                  <?php echo $data3[$type]; ?>
                  </div>
                  <div class="col-sm-1 col-md-1 col-lg-1"></div>
                  </ContentArticle>
              </div>
          </fieldset>
      </div>
      
    <?php    break;
  }
?>
<style>
  .thecomments{display: none;}
  .controlArea{background: white;}
  .commenttitle{font-size: 16px; background: rgb(0, 149, 204); line-height: 40px; text-align: center; color:white; margin-bottom: 5px;}
  .form-control{font-size: 16px;}
  .subArticle{font-size: 17px; color:crimson; font-weight: bold; text-decoration: underline; font-family:fantasy;}
  .highlight { background-color: yellow; }
</style>