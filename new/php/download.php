<?php
if (isset($_GET['pdf'])){
    $pdf=$_GET['pdf'];
  
     
    // Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
    header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
    header('Content-Disposition: attachment; filename="'.$pdf.'"'); //Nom du fichier
    header('Content-Length: ' . filesize($pdf)); //Taille du fichier
    readfile($pdf);}
?>