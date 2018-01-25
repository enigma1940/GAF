<?php
  try{
    $bdd=new PDO('mysql:dbname=gafdb;host=localhost','root', 'T@lentys2017');
  }catch(Exception $e){
    die('Error : '.$e->getMessage());
  }
?>
