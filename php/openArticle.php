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
        $ar->read($bdd); ?>
        <div class="col m12 controlArea" style="margin-bottom: 0px;"><button class="btn waves-effect waves-light blue darken-2 hide-on-med-and-down catCh col m2"><i class="material-icons left">launch</i>Catégories</button>

        <button class="btn waves-effect waves-light hide-on-large-only catCh col s2 m2"><i class="material-icons">launch</i></button>

          <div class="col s12 m5 links"><a class="col m4 jsscroll" href="#deliberation">Deliberations</a>
          <a class="col s5 m5 jsscroll truncate" href="#communication">Communications orales</a>
          <a class="col s3 m3 jsscroll" href="#nomination">Nominations</a></div>
          <form class="col s12 m5 innerSearch">
            <div class="input-field col m10" style="margin: 0px; padding: 0px;">
              <input type="text" class="inSearch" placeholder="Rechercher dans le texte" />
            </div>
            <div class="input-field col m2" style="margin: 0px; padding: 0px;"><button type="submit" class="btn-floating waves-effect waves-light grey darken-3"><i class="material-icons">search</i></button></div>
          </form>
        </div>

        <?php echo '<div class="tt" data="'.$ar->getId().'">
            <div class="col s12 m12 toggle-visibility sticky-top" data-target="#textComplete">
              <h4 style="background: #fff; padding: 8px; cursor: pointer;">'.$ar->getTitle().'<span style="font-size: 12px; color: #333;">  ( Cliquer pour lire) </span></h4>
            </div>
            <div class="col s12 m10 offset-m1" id="textComplete">'.$ar->getContent().$ar->getDeliberation().$ar->getCommunication().$ar->getNomination().'</div>
          </div>'; ?>
          <script src="js/jquery.highlight-5.closure.js"></script>
          <style>.highlight { background-color: yellow; }</style>
          <div class="commentArea col s12 m12">
            <button class="btn blue waves-effect waves-light showComments">Voir les commentaires</button>
            <button class="btn grey waves-effect waves-light showCommentCom"><i class="material-icons left">comment</i>Commenter</button>
            <button class="btn waves-effect waves-light contRead"><i class="material-icons left">chrome_reader_mode</i>Continuer la lecture</button>
          </div>
          <div class="col-sm-12 thecomments"></div>
          <div class="popup">
            <div class="row commentZone">
              <div class="col m10 offset-m1 sendComment" style="display: none;">
                <form class="postCommentForm col m8 offset-m2 white">
                  <div class="col m12 commenttitle">Laisser un commentaire</div>
                  <div class="input-field col m12">
                    <input type="text" class="commentUname" />
                    <label>Entrer un identifiant, pseudo</label>
                  </div>
                  <div class="input-field col m12">
                    <input type="email" class="mailComment" />
                    <label>Entrer votre adresse mail</label>
                  </div>
                  <div class="input-field col m12">
                    <textarea class="commentText materialize-textarea" rows="3"></textarea>
                    <label>Entrer votre commentaire ici</label>
                  </div>
                  <input type="submit" class="btn btn-primary" value="Poster">
                  <button type="button" class="btn waves-effect waves-light pink darken-4 btnClose"><i class="material-icons">clear</i>Fermer</button>
                  <font class="col-sm-12" class="errComment" style="color: rgb(190, 0, 57); display: none;">Une erreur est survenue</font>
                </form>
              </div>
            </div>
          </div>
          <style>
            .popup{position: fixed; height: 100%; width: 100%; background: rgba(0,0,0,0.8); z-index: auto; top: 0; left: 0; display: none;}
          </style>
          <script type="text/javascript">
          $('.showCommentCom').click(function(){
            $('.popup').css('display','block');
            $('.sendComment').toggle('drop');
          });
          $('.btnClose').click(function(){
            $('.sendComment').toggle('drop');
            $('.popup').css('display', 'none');
          });
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
                $('.thecomments').html('<img src="fonts/loader.gif" />');
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
              $('.postCommentForm')[0].reset();
            }else{
              $('.errComment').toggle('drop');
            }
            $('.commentUname').val(''); $('.commentText').val('');
          });
            //var h = parseFloat($('header').height())+parseFloat($('.sssc').height());
            //alert(h);
            $(document).scroll(function(){
              if ($(window).scrollTop() >= parseFloat($('header').height())+parseFloat($('.sssc').height())) {
                  $('.controlArea').css({'position': 'fixed', 'top':'0'});
                } else {
                  $('.controlArea').css({'position': 'static', 'top':'0'});
                }
              });

            $('.links').css('line-height', $('.catCh').css('height'));
            $('#textComplete').show();
            $('.showCommentCom').click(function(){
              /*$('.popup').css('.display','block');
              $('.sendComment').toggle('drop');*/
            });
            $('.innerSearch').submit(function(e){
              e.preventDefault();
              if($('.inSearch').val()){
                $('#textComplete').removeHighlight().highlight($('.inSearch').val());

                try{
                  $('html, body').animate({
                    scrollTop: $('.highlight:visible:first').offset().top-$('.controlArea').height()
                  }, 500);}
                catch(err){}
                }
            });
            $('.toggle-visibility').click(function(){
              if($(this).attr('class')=='col-sm-12 toggle-visibility'){
                $(this).attr('class', 'col-sm-12 toggle-visibility sticky-top');
                $($(this).attr('data-target')).show('slow');
              }else{
                $(this).attr('class', 'col-sm-12 toggle-visibility');
                $($(this).attr('data-target')).hide('slow');
              }
            });
            $('.postCommentForm').submit(function(e){
              $('.errComment').css('display', 'none');
              if($('.commentUname').val()!="" && $('.commentText').val()!=""){
                e.preventDefault();
                $.post(
                  'php/openArticle.php',
                  {
                    opt:'sendComment',
                    uname: $('.commentUname').val(),
                    content: $('.commentText').val(),
                    article: $('.tt').attr('data')
                  },
                  function(data){
                    //alert(data);
                  }
                );
              }else{
                $('.errComment').toggle('drop');
              }
              $('.commentUname').val(''); $('.commentText').val('');
            });
            $('.contRead').click(function(){
              $('.thecomments').css('display', 'none');
              $('.articles').css('display','none');
              $('.paginator').css('display', 'none');
              $('#textComplete').hide();
              $('.articles').toggle('drop');
              $('.paginator').css('display', 'block');
            });
            $('.catCh').click(function(){
              $('.catArea').toggle('drop');
            });
            $('.jsscroll').on('click', function() {
              try{
                var page = $(this).attr('href');
            	  var speed = 500;
                //alert($(page).offset().top);
          	    $('html, body').animate( { scrollTop: $(page).offset().top-$('.controlArea').height() }, speed ); // Go
            	  return false;
              }catch(err){
                return false;
              }
            });
          </script>

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
    echo '<div class="col m12 controlArea" style="margin-bottom: 0px;"><button class="btn waves-effect waves-light btnBackSearch blue darken-2 col m2"><i class="material-icons left">arrow_back</i>Retour</button>
      <div class="col m5 links"><a class="col m4 jsscroll" href="#deliberation">Deliberations</a>
      <a class="col m5 jsscroll" href="#communication">Communications orales</a>
      <a class="col m3 jsscroll" href="#nomination">Nominations</a></div>
      <form class="col m5 innerSearch">
        <div class="input-field col m10" style="margin: 0px; padding: 0px;">
          <input type="text" class="inSearch" placeholder="Rechercher dans le texte" />
        </div>
        <div class="input-field col m2" style="margin: 0px; padding: 0px;"><button type="submit" class="btn waves-effect waves-light grey darken-3"><i class="material-icons">search</i></button></div>
      </form>
    </div>
      <div class="tt" data="'.$ar->getId().'">
        <div class="col m12 toggle-visibility sticky-top" data-target="#textComplete">
          <h4 style="background: #fff; padding: 8px;">'.$ar->getTitle().'<span style="font-size: 12px; color: #333;">  ( Cliquer pour lire) </span></h4>
        </div>
        <div class="col m10 offset-m1" id="textComplete">'.$ar->getContent().$ar->getDeliberation().$ar->getCommunication().$ar->getNomination().'</div>
      </div>'; ?>

      <script src="js/jquery.highlight-5.closure.js"></script>
      <style>.highlight { background-color: orange; }</style>
      <script>
      $('#textComplete').removeHighlight().highlight($('.searchBar').val());
      try{
        $('html, body').animate({
          scrollTop: $('.highlight:visible:first').offset().top -$('.controlArea').height()
        }, 500);
      }catch(err){}
      </script>

      <div class="commentArea col m12">
        <button class="btn blue waves-effect waves-light showComments">Voir les commentaires</button>
        <button class="btn grey waves-effect waves-light showCommentCom"><i class="material-icons left">comment</i>Commenter</button>
      </div>
      <div class="col-sm-12 thecomments"></div>
      <div class="popup">
        <div class="row commentZone">
          <div class="col m10 offset-m1 sendComment" style="display: none;">
            <form class="postCommentForm col m8 offset-m2 white">
              <div class="col m12 commenttitle">Laisser un commentaire</div>
              <div class="input-field col m12">
                <input type="text" class="commentUname" />
                <label>Entrer un identifiant, pseudo</label>
              </div>
              <div class="input-field col m12">
                <input type="email" class="mailComment" />
                <label>Entrer votre adresse mail</label>
              </div>
              <div class="input-field col m12">
                <textarea class="commentText materialize-textarea" rows="3"></textarea>
                <label>Entrer votre commentaire ici</label>
              </div>
              <input type="submit" class="btn btn-primary" value="Poster">
              <button type="button" class="btn waves-effect waves-light pink darken-4 btnClose"><i class="material-icons">clear</i>Fermer</button>
              <font class="col-sm-12" class="errComment" style="color: rgb(190, 0, 57); display: none;">Une erreur est survenue</font>
            </form>
          </div>
        </div>
      </div>
      <style>
        .popup{position: fixed; height: 100%; width: 100%; background: rgba(0,0,0,0.8); z-index: auto; top: 0; left: 0; display: none;}
      </style>
      <script type="text/javascript">
        $('.btnBackSearch').click(function(){
          $('.bigArea').css('display','none');
          $('.searchResult').toggle('drop');
          $('.catArea').css('display', 'block');
          $('.articles').css('display', 'block');
          $('.paginator').css('display', 'block');
        });

        $('#textComplete').show();
        $('.showCommentCom').click(function(){
          alert('yo');
          $('.popup').css('display','block');
          $('.sendComment').toggle('drop');
        });
        $('.btnClose').click(function(){
          $('.sendComment').toggle('drop');
          $('.popup').css('display', 'none');
        });

        $('.toggle-visibility').click(function(){
          if($(this).attr('class')=='col-sm-12 toggle-visibility'){
            $(this).attr('class', 'col-sm-12 toggle-visibility sticky-top');
            $($(this).attr('data-target')).show('slow');
          }else{
            $(this).attr('class', 'col-sm-12 toggle-visibility');
            $($(this).attr('data-target')).hide('slow');
          }
        });
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
            $('.sendComment').toggle('drop');
            $('.popup').css('display', 'none');
            $('.postCommentForm')[0].reset();
          }else{
            $('.errComment').toggle('drop');
          }
          $('.commentUname').val(''); $('.commentText').val('');
        });
        $('.contRead').click(function(){
          $('.articles').css('display','none');
          $('.paginator').css('display', 'none');
          $('#textComplete').hide();
          $('.articles').toggle('drop');
          $('.paginator').css('display', 'block');
        });
        $('.catCh').click(function(){
          $('.catArea').toggle('drop');
        });
        $('.jsscroll').on('click', function() {
          try{
            var page = $(this).attr('href');
            var speed = 500;
            $('html, body').animate( { scrollTop: $(page).offset().top-$('.controlArea').height() }, speed ); // Go
            return false;
          }catch(err){
            //
            return false;
          }
        });
      $(document).scroll(function(){
        if ($(window).scrollTop() >= parseFloat($('header').height())+parseFloat($('.sssc').height())) {
            $('.controlArea').css({'position': 'fixed', 'top':'0'});
          } else {
            $('.controlArea').css({'position': 'static', 'top':'0'});
          }
        });

        $('.innerSearch').submit(function(e){
          e.preventDefault();
          if($('.inSearch').val()){
            $('#textComplete').removeHighlight().highlight($('.inSearch').val());
            try{
              $('html, body').animate({
                scrollTop: $('.highlight:visible:first').offset().top -$('.controlArea').height()
              }, 500);}
            catch(err){}
          }
        });
        $('.showComments').click(function(){
          $('.thecomments').html('<img src="fonts/loader.gif" />');
          $('.thecomments').toggle('drop');
          $.post(
            'php/openArticle.php',
            {opt: 'showComment', article: $('.tt').attr('data')},
            function(data){
              $('.thecomments').html(data);
            }
          );
        });
      </script>
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
        while($d=$r->fetch()){
          echo '<div class="col m6 comZone">
            <div class="col m12 teal" style="color: white;">'.$d['uname'].'<font class="right">'.$d['datec'].'</font></div>
            <div class="col m12" style="border: solid 1px rgb(0, 150, 136);">'.$d['content'].'</div>
          </div>';
        }
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
      <div class="col s12 m12">
        <div class="col s4 m4"><a class="btn waves-effect waves-light blue darken-2 goBack"><i class="material-icons left">arrow_back</i>Retour</a></div>
        <form class="col s8 m8 innerSearch">
          <div class="col m9 s8">
            <input type="text" class="inSearch" placeholder="Rechercher dans l'article" />
          </div>
          <button type="submit" class="btn-floating waves-effect grey darken-2 waves-light"><i class="material-icons">search</i></button>
        </form>
      </div>
      <div class="col m12 s12"><h3 class="hide-on-md-and-down"><?php echo $data3['title']; ?></h3>
        <font class="flow-text hide-on-large-only"><?php echo $data3['title']; ?></font>
      </div>
      <div class="col m10 s12 offset-m1" id="textComplete"><?php echo $data3[$type]; ?></div>
      <script src="js/jquery.highlight-5.closure.js"></script>
      <style>.highlight{background-color: #fc0; }</style>
      <script>
        //jQuery.fn.highlight=function(c){function e(b,c){var d=0;if(3==b.nodeType){var a=b.data.toUpperCase().indexOf(c),a=a-(b.data.substr(0,a).toUpperCase().length-b.data.substr(0,a).length);if(0<=a){d=document.createElement("span");d.className="highlight";a=b.splitText(a);a.splitText(c.length);var f=a.cloneNode(!0);d.appendChild(f);a.parentNode.replaceChild(d,a);d=1}}else if(1==b.nodeType&&b.childNodes&&!/(script|style)/i.test(b.tagName))for(a=0;a<b.childNodes.length;++a)a+=e(b.childNodes[a],c);return d} return this.length&&c&&c.length?this.each(function(){e(this,c.toUpperCase())}):this};jQuery.fn.removeHighlight=function(){return this.find("span.highlight").each(function(){this.parentNode.firstChild.nodeName;with(this.parentNode)replaceChild(this.firstChild,this),normalize()}).end()};
        try{
          $('#textComplete div').removeHighlight().highlight($('.searchBar').val());
          $('html, body').animate({scrollTop: $('.highlight:visible:first').offset().top}, 500);
        }catch(err){

        }
        $('.innerSearch').submit(function(e){
          e.preventDefault();
          if($('.inSearch').val()){
            try{
              $('#textComplete div').removeHighlight().highlight($('.inSearch').val());
              $('html, body').animate({scrollTop: $('.highlight:visible:first').offsetTop}, 500);
            }catch(err){}
          }
        });

        $('.goBack').click(function(){
          $('.resultOpen').hide();
          $('.resultOpen').html('');
          $('.resultArea').toggle('fade');
        });
      </script>


  <?php    break;
  }
?>
<style>
  .thecomments{display: none;}
  .controlArea{background: white;}
  .commenttitle{font-size: 16px; background: rgb(0, 149, 204); line-height: 40px; text-align: center; color:white; margin-bottom: 5px;}
  .form-control{font-size: 16px;}
  .subArticle{font-size: 20px; color: rgb(95, 0, 140); font-style: bold;}
  p{text-align:justify;}
</style>
