<?php
include_once('connectdb.php');
switch ($_POST['opt']) {
  case 'zoom':

      $req;
      $m = $_POST['month']<10? '0'.$_POST['month'] : $_POST['month'];
      #echo '<h4>'.$_POST['sect'].' '.$m.'</h4>';
      switch($_POST['sect']){
        case 'Délibérations':
            $req=$bdd->prepare('SELECT ID, datea, title, deliberation as bulk, (SELECT COUNT(deliberation) from conseil WHERE datea like :param AND deliberation!="") AS CT FROM conseil WHERE datea like :param AND deliberation !="" ORDER BY ID DESC');
            $req->execute(array(':param'=>$_POST['year'].'-'.$m.'%'));
          break;
        case 'Nominations':
            $req=$bdd->prepare('SELECT ID, datea, title, nomination as bulk, (SELECT COUNT(nomination) from conseil WHERE datea like :param AND nomination!="") AS CT FROM conseil WHERE datea like :param AND nomination!="" ORDER BY ID DESC');
            $req->execute(array(':param'=>$_POST['year'].'-'.$m.'%'));
          break;
        case 'Communication Orales':
            $req=$bdd->prepare('SELECT ID, datea, title, communication as bulk, (SELECT COUNT(communication) from conseil WHERE datea like :param AND communication!="") AS CT FROM conseil WHERE datea like :param AND communication!="" ORDER BY ID DESC');
            $req->execute(array(':param'=>$_POST['year'].'-'.$m.'%'));
          break;
      }
      while($data=$req->fetch()){ ?>
         <a class="modal-trigger" href="<?php echo '#modal'.$data['ID'] ?>">
            <div class="col m12 waves-effect" style="line-height: 30px;">
              <?php echo $data['title']; ?>
              <span class="red-text right"><?php echo $data['datea']; ?></span>
            </div>
          </a>
          <div class="modal" id="<?php echo 'modal'.$data['ID'] ?>">
            <p><?php echo $data['bulk'] ?></p>
          </div>
      <?php } ?>
      <style>.subArticle{font-size: 20px; color: /*rgb(95, 0, 140)*/ rgb(0, 122, 249); font-style: bold;}</style>
      <script type="text/javascript">
      $(document).ready(function(){
          // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
          $('.modal').modal();
        });
      </script>

    <?php
    break;

  default:
    # code...
    break;
}


 ?>
