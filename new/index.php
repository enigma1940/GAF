<?php
  include_once('php/connectdb.php');
  function loadclass($class) {
    include 'php/classes/' .$class. '.class.php';
  }
  spl_autoload_register('loadclass');
  $search = new Search();
  
  if(isset($_GET['pagel']))
  {
      echo '<input type="hidden" value="0" class="indicator" />';
  }

  if(isset($_GET['pager']))
  {
      echo '<input type="hidden" value="1" class="indicator" />';
  }
        
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Remplacer la ligne du dessus par celle-ci pour désativer le zoom -->
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
        <meta name="description" content="gouvernance, institutions, publiques, textes de lois, rapports, comptes rendus, conseil, ministre">
        <meta name="GAF" content="Gouvernance Accès Facile">
        <!-- Permet d'afficher un icône dans la barre d'adresse -->
        <link rel="shortcut icon" href="images/icone1.png">
        <title>GAF, Gouvernance Accès Facile</title>
 
        <!-- Fichiers CSS -->
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="style/style.css" rel="stylesheet">
        <link href="style/font.css" rel="stylesheet">
        
        <!-- Fichiers javascript -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="script/jquery.js"></script>
        <script src="script/jquery.highlight-5.closure.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/main.js"></script>
        <script src="script/scroll.js"></script>
        <script type="text/javascript">
            function autocollapse() {
                var navbar = $('.navbar.navbar-autocollapse');
                navbar.removeClass('collapsed');
                if(navbar.innerHeight() > 50) {
                    navbar.addClass('collapsed');
                }
            }
            $(function () {
                $(window).on('resize', autocollapse); });
        </script>
        
        
        <!-- HTML5 Shim et Respond.js permet à IE8 de supporter les éléments du HTML5 -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Notre entête -->
        <div class="container-fluid" id="head">
            <div class="container marge">
                <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 marge">
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 marge" align="left">
                    <img src="images/logo.PNG" class="img-responsive" />
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-16 col-lg-16 marge" align="right">
                    <img src="images/bienvenue.PNG" class="img-responsive hidden-xs" id="partenaires" />
                   </div>
                </div>
            </div>
        </div>
        
        <!-- Notre menu -->
        <nav class="navbar navbar-default navbar-autocollapse menu toggle-visibility" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#" id="gafmenu"><a1>G</a1><a2>A</a2><a3>F</a3></a>
            </div>
            <div class="collapse navbar-collapse navbar-ex2-collapse" id="taillemenu">
              <ul class="nav navbar-nav">
                <li id="ACC"><a href="#" class="btnHome">ACCUEIL</a></li>
                <li class=""><a href="index.php#categories">CATEGORIES</a></li>
                <li class=""><a href="index.php#articles">ARTICLES</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li id="PRO"><a href="#" class="btnApropos">A PROPOS</a></li>
              </ul>
            </div>
          </div>
        </nav>
        
        <!-- Notre corps -->
        <div class="container-fluid">
        <div class="container" id="corps">
            <div class="row bigArea">
                <!-- Message d'accueil -->
                <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 Bienvenue" style="margin-top:10px;">
                    <div class="message message-success" style="padding-top:3px; padding-bottom:3px;">
                        <img src="images/defil.gif" class="img-responsive"/>
                    </div>
                </div>
                <!-- Zone de recherche -->
                <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 Recherche" id="RechS" style="margin-top:10px;">
                    <fieldset>
                        <legend class="field">Zone de recherche <span style="font-size:11px;">Cette recherche concerne à la fois les conseils de ministres, les textes de lois et les rapports des institutions publiques</span></legend>
                        <!-- Champs de recherche -->
                        <form role="form" name="form" action="" method="post" class="searchForm">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <input type="text" placeholder="Entrer un mot clé / une date / un nom" name="s" class="form-control left-rounded searchText">
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <button type="submit" class="btn  btn-success" align="right"><i class="icon icon-search"></i>&nbsp;Rechercher</button>
                                        <button type="submit" class="btn  btn-primary" id="avancee"><i class="icon icon-long-arrow-right"></i>&nbsp;Avancée</button>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <!-- Recherche avancée -->
                <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 Recherche" id="RechA" style="margin-top:10px; margin-bottom:-1%;">
                    <fieldset>
                        <legend class="field">Recherche avancée <span style="font-size:12px;">Cette recherche concerne uniquement les conseils de ministres</span></legend>
                        <!-- Champs de recherche -->
                        <form role="form" name="form" action="" method="post" class="searchForm2">
                            <div class="row">
                                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
                                    <input type="text" placeholder="Entrer un mot clé / une date / un nom" name="s" class="form-control left-rounded searchBar">
                                </div>
                                <div class="param">
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-5">
                                    <div class="form-group">
                                        <select class="form-control mois">
                                            <option value="0">MOIS</option>
                                            <optgroup label="Quel mois ?">
                                            <?php $search->months($bdd); ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-5">
                                    <select class="form-control annee">
                                            <option value="0">ANNEE</option>
                                            <optgroup label="Quelle année ?">
                                            <?php $search->years($bdd); ?>
                                            </optgroup>
                                    </select>
                                </div>
                                </div>
                                <div class="col-xs-12 col-sm-24 col-md-24 col-lg-6">
                                        <button type="submit" class="btn  btn-success"><i class="icon icon-search"></i>&nbsp;Rechercher</button>
                                        <button type="submit" class="btn  btn-primary" id="Ravancee"><i class="icon icon-long-arrow-left"></i>&nbsp;Simple</button>
                                </div>

                            </div>
                        </form>
                    </fieldset>
                </div>
                <!-- Nos catégories -->
                <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 Categories" style="margin-top:20px;">
                    <fieldset>
                        <legend class="field" id="categories">Nos catégories</legend>
                            <div class="row taillecat">
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <center>
                                        <a href="#" class="liencat catactiveA">
                                        <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
                                            <i class="icon icon-file-text icon-3x"></i>
                                        </div>
                                        <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
                                            Conseils de ministres
                                        </div>
                                        </a>
                                    </center>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <center>
                                        <a href="#" class="liencat catactiveB">
                                        <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
                                            <i class="icon  icon-file icon-lg"></i>
                                            <i class="icon icon-legal icon-3x"></i>
                                        </div>
                                        <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
                                            Textes de lois
                                        </div>
                                        </a>
                                    </center>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <center>
                                        <a href="#" class="liencat catactiveC">
                                        <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
                                            <i class="icon icon-book icon-3x"></i>
                                        </div>
                                        <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
                                            Rapports des institutions
                                        </div>
                                        </a>
                                    </center>
                                </div>
                            </div>
                    </fieldset>
             </div>
             <!-- Les dernières nouvelles -->
             <?php
                $a = new Article();
                $r = $bdd->query('SELECT MAX(ID) as m FROM conseil');
                $d = $r->fetch();
                $a->setId($d['m']); $a->read($bdd);
              ?>
             <fieldset class="col-xs-12 col-sm-24 col-md-24 col-lg-24 Nouvelles" style="margin-top:30px;">
                 <legend style="font-size:18px; margin-bottom:0;" id="lastnew">Les dernières nouvelles&nbsp;&nbsp;<i class="icon  icon-caret-down"></i></legend>
             <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" id="contenunew" style="padding-top:none;">
                 <ul class="nav nav-tabs nav-inverse" id="myTab" style="margin-top:10px; font-size:17px;">
                     <li class="active"><a data-toggle="tab" href="#menu1">Comptes rendus des conseils de ministres</a></li>
                     <li><a data-toggle="tab" href="#menu2">Textes de lois</a></li>
                     <li><a data-toggle="tab" href="#menu3">Rapports des institutions publiques</a></li>
                 </ul>
                 <div class="tab-content" id="myTabContent">
                     <div id="menu1" class="tab-pane fade active in">
                        <h3 class="titleA" style="padding-bottom:0px;" data="#textComplete"><?php echo $a->getTitle(); ?><span style="font-size: 12px; color: #333;">( Cliquer pour lire)</span></h3>
                        <div id="textComplete" align="justify"><div class="col-sm-1 col-md-1 col-lg-1"></div><div class="col-xs-12 col-sm-22 col-md-22 col-lg-22"><?php echo $a->getContent().$a->getDeliberation().$a->getCommunication().$a->getNomination(); ?></div><div class="col-sm-1 col-md-1 col-lg-1"></div></div>
                     </div>
                     <div id="menu2" class="tab-pane fade">
                      <?php
                         $lloi = $bdd->prepare("SELECT ID, title, filelink from loi ORDER BY ID DESC");
                         $lloi->execute();
                         $lastloi = $lloi->fetch();
                         echo '<h4><a style="font-weight:bold;" class="titleA" href="'.$lastloi['filelink'].'" target="_blank">'.$lastloi['title'].'</a><span style="font-size: 12px; color: #333;">( Cliquer pour lire)</span></h4>';
                      ?>
                     </div>
                     <div id="menu3" class="tab-pane fade">
                        <?php
                         $lrap = $bdd->prepare("SELECT ID, title, filelink from rapport ORDER BY ID DESC");
                         $lrap->execute();
                         $lastrap = $lrap->fetch();
                         echo '<h4><a style="font-weight:bold;" class="titleA" href="http://www.planificationfamiliale-burkinafaso.net/'.$lastrap['filelink'].'" target="_blank">'.$lastrap['title'].'</a><span style="font-size: 12px; color: #333;">( Cliquer pour lire)</span></h4>';
                        ?>
                     </div>
                 </div>
             </div>
             </fieldset>
            
            <!-- Nos vignettes CR-CM -->
            <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 Articles Conseil" id="articles" style="margin-top:20px;">
            <fieldset>
                <legend class="field" id="articlesC">Faites votre choix <span style="font-size:12px;">Zone des articles (Comptes rendus des conseils de ministres)</span></legend>
                <div class="row">
                    <?php
                        $pages = new PaginatorC();
                        /*$pages->cat='cr-cm';*/
                        $limit = 'LIMIT '.($pages->PageActive($bdd) - 1) * $pages->NbreArticlesParPage().','.$pages->NbreArticlesParPage();
                        $sql = $bdd->prepare("SELECT ID, title, content, deliberation, nomination, communication, datea from conseil ORDER BY ID DESC $limit");
                        $sql->execute();
                        $i=0;
                    
                        while($data = $sql->fetch()){
                            
                            // Suppression des balises, rassemblage du texte
                            $data['content'] = strip_tags($data['content']);
                            $data['deliberation'] = strip_tags($data['deliberation']);
                            $data['nomination'] = strip_tags($data['nomination']);
                            $data['communication'] = strip_tags($data['communication']);
                            $i=$i+1;
                            
                            // Troncature du texte
                            if(strlen($data['title'])>55){$data['title']=substr($data['title'], 0, 55).'...';}
                            if(strlen($data['content'])>180){$data['content']=substr($data['content'], 0, 180).'...';}
                            if(strlen($data['deliberation'])>55){$data['deliberation']=substr($data['deliberation'], 0, 55).'...';}
                            if(strlen($data['nomination'])>50){$data['nomination']=substr($data['nomination'], 0, 50).'...';}
                            if(strlen($data['communication'])>50){$data['communication']=substr($data['communication'], 0, 50).'...';}
                            
                            // Nombre de commentaires pour cahque article
                            $cn=$bdd->prepare('SELECT COUNT(*) as n FROM comment WHERE article=?');
                            $cn->execute(array($data['ID']));
                            $dn=$cn->fetch();
                            
                    echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 article" style="margin-bottom:15px; background-color:whitesmoke; border-radius:10px; border:1px solid whitesmoke;">
                        <input type="hidden" class="onearticle" value="'.$data['ID'].'" />
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object img-rounded" alt="CR - CM" style="width: 64px; height: 64px; font-weight:bold;" src="images/crcm'.$i.'.jpg"></a>
                            </div>
                            <a class="media-body" href="#" style="color:black;">
                            <div align="justify">
                                <h4 class="media-heading" style="font-weight:bold;">'.$data['title'].'</h4>';
                                if($data['content'] != '')
                                {
                                    echo $data['content'];
                                }
                                else
                                {                                    
                                    echo $data['deliberation'].' '.$data['communication'].'... '.$data['nomination'];
                                }
                            echo'<table width=100%>
                                <tr>
                                <td align="left" style="color:cornflowerblue;">Commentaires : '.$dn['n'].'</td>
                                <td align="right" style="color:red;">'.$data['datea'].'</td>
                                </tr>
                                </table>
                            </div>
                            </a>
                        </div>
                    </div></div>';
                     }
                   ?>
                    <?php
                        echo '<div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 paginator" align="center" style="margin-top:20px;">';
                                $pages->pageArea($bdd);
                        echo '</div>';
                      ?>
                </div>
            </fieldset>
          </div>
          <!-- Nos vignettes Lois -->
            <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 Articles Lois" id="articles" style="margin-top:20px;">
            <fieldset>
                <legend class="field" id="articlesL">Faites votre choix <span style="font-size:12px;">Zone des articles (Textes de lois)</span></legend>
                <div class="row">
                    <?php
                        $page = new PaginatorL();
                        /*$pages->cat='cr-cm';*/
                        $limite = 'LIMIT '.($page->PageActive($bdd) - 1) * $page->NbreArticlesParPage().','.$page->NbreArticlesParPage();
                        $sql = $bdd->prepare("SELECT ID, title, filelink from loi ORDER BY ID DESC $limite");
                        $sql->execute();
                        $i=0;
                    
                        while($data = $sql->fetch()){
                            $i+=1;
                            // Troncature du texte
                            if(strlen($data['title'])>103){$data['title']=substr($data['title'], 0, 103).'...';}
                            
                    echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-bottom:15px; background-color:whitesmoke; border-radius:10px; border:1px solid whitesmoke;">
                        <input type="hidden" class="onearticle" value="'.$data['ID'].'" />
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object img-rounded" alt="TXT - LOIS" style="width: 64px; height: 64px; font-weight:bold;" src="images/txt'.$i.'.jpg"></a>
                            </div>
                            <div class="media-body" style="color:black;">
                            <div align="justify">
                                <h5 class="media-heading" style="font-weight:bold;">'.$data['title'].'</h5>';
                            echo'<table width=100%>
                                <tr>
                                <td align="left"><a href="'.$data['filelink'].'" target="_blank"><i class="icon icon-lg icon-file-pdf-o" style="color:red;"></i></a></td>
                                <td align="right"><a class="btn  btn-success" type="application/pdf" href="'.$data['filelink'].'" target="_blank"><i class="icon icon-download"></i>&nbsp;TELECHARGER</a></td>
                                </tr>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div></div>';
                     }
                   ?>
                    <?php
                        echo '<div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 paginator" align="center" style="margin-top:20px;">';
                                $page->pageArea($bdd);
                        echo '</div>';
                      ?>
                </div>
            </fieldset>
          </div>
          <!-- Nos vignettes Rapports -->
            <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 Articles Rapports" id="articles" style="margin-top:20px;">
            <fieldset>
                <legend class="field" id="articlesR">Faites votre choix <span style="font-size:12px;">Zone des articles (Rapports des institutions publiques)</span></legend>
                <div class="row">
                    <?php
                        $page = new PaginatorR();
                        /*$pages->cat='cr-cm';*/
                        $limite = 'LIMIT '.($page->PageActive($bdd) - 1) * $page->NbreArticlesParPage().','.$page->NbreArticlesParPage();
                        $sql = $bdd->prepare("SELECT ID, title, filelink from rapport ORDER BY ID DESC $limite");
                        $sql->execute();
                        $i=0;
                    
                        while($data = $sql->fetch()){
                            $i+=1;
                            // Troncature du texte
                            if(strlen($data['title'])>105){$data['title']=substr($data['title'], 0, 105).'...';}
                            
                    echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="col-xs-12 col-sm-24 col-md-24 col-lg-24" style="margin-bottom:15px; background-color:whitesmoke; border-radius:10px; border:1px solid whitesmoke;">
                        <input type="hidden" class="onearticle" value="'.$data['ID'].'" />
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object img-rounded" alt="Rapport" style="width: 64px; height: 64px; font-weight:bold;" src="images/rap'.$i.'.jpg"></a>
                            </div>
                            <div class="media-body" style="color:black;">
                            <div align="justify">
                                <h5 class="media-heading" style="font-weight:bold;">'.$data['title'].'</h5>';
                            echo'<table width=100%>
                                <tr>
                                <td align="left"><a href="http://www.planificationfamiliale-burkinafaso.net/'.$data['filelink'].'" target="_blank"><i class="icon icon-lg icon-file-pdf-o" style="color:red;"></i></a></td>
                                <td align="right"><a class="btn  btn-success" type="application/pdf" href="http://www.planificationfamiliale-burkinafaso.net/'.$data['filelink'].'" target="_blank"><i class="icon icon-download"></i>&nbsp;TELECHARGER</a></td>
                                </tr>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div></div>';
                     }
                   ?>
                    <?php
                        echo '<div class="col-xs-12 col-sm-24 col-md-24 col-lg-24 paginator" align="center" style="margin-top:20px;">';
                                $page->pageArea($bdd);
                        echo '</div>';
                      ?>
                </div>
            </fieldset>
          </div>
        </div>
        <div class="row searchResult"></div>
        <div class="row Art"></div>
        <div class="row a"></div>
        <div class="row col-xs-12 col-sm-24 col-md-24 col-lg-24 Apropos"></div>
        </div>
        </div>
        <!-- Notre pieds -->
        <div class="container-fluid" id="pieds">
            <div class="container">
                <div class="row police taillepieds">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
                        <img src="images/partenaires.PNG" class="img-responsive bf"/>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="right" style="color:green;">
                        GAF, Gouvernance Accès Facile
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="footer">
        </div>
        <a href="#" title="Haut de page" class="scrollup"><i class="icon icon-chevron-up"></i></a>
    <script src="script/home.js"></script>
    </body>
</html>