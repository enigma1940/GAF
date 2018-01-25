<?php
  try{
    $bdd=new PDO('mysql:dbname=gafdb;host=localhost','root', '');
  }catch(Exception $e){
    die('Error : '.$e->getMessage());
  }
  function buildString($s, $cont){
    return $cont.' LIKE "%'.str_replace(' ', '%" AND '.$cont.' LIKE "%', $s).'%"';
  }
  function buildString2($s){
    return 'SELECT ID, title, datea FROM conseil WHERE
                (title LIKE "%'.str_replace(' ', '%" AND title LIKE "%', $s).'%")
            OR (content LIKE "%'.str_replace(' ', '%" AND content LIKE "%', $s).'%")
            OR (deliberation LIKE "%'.str_replace(' ', '%" AND deliberation LIKE "%', $s).'%")
            OR (nomination LIKE "%'.str_replace(' ', '%" AND nomination LIKE "%', $s).'%")
            OR (communication LIKE "%'.str_replace(' ', '%" AND communication LIKE "%', $s).'%")';
  }
  function correctString($s, $cont){
    return $cont.' REGEXP "'.str_replace(' ', '|', $s).'"';
  }
?>
