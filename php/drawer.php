<?php
  require('connectdb.php');
  require('classes/Search.class.php');

  $se=new Search();
  //$se->breakDown($bdd, 2017);

  switch (htmlspecialchars($_GET['option'])) {
    case 'yearInfo':
        $se->breakDown($bdd, htmlspecialchars($_GET['year']));
      break;

    default:
      # code...
      break;
  }
?>
