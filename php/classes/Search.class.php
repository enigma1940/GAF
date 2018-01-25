<?php

class breaker{
  public $delib, $nom, $com;
  public function __construct($d, $n, $c){
    $delib=$d;
    $nom=$n;
    $com=$c;
  }
}

class Search{
  private $annee, $mois, $type, $text;

  public function getAnnee(){return $this->annee;}
  public function getMois(){return $this->mois;}
  public function getType(){return $this->type;} //Deliberation - communication - nominations
  public function getText(){return $this->text;}

  public function setAnnee($i){$this->annee=$i;}
  public function setMois($i){$this->mois=$i;}
  public function setType($i){$this->type=$i;}
  public function setText($i){$this->text=$i;}

  public function __construct(){$this->annee=''; $this->mois=''; $this->type=''; $this->text='';}

  public function searchTextYear($bdd){
    $r = array();

    $req0=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND deliberation LIKE :deliberation ORDER BY ID DESC');
    $req0->execute(array(
      ':datea'=>$this->getAnnee().'%',
      ':deliberation'=>'%'.str_replace(' ', '%', $this->getText()).'%'
    ));
    if($req0->rowCount()==0){
      $req0=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND deliberation REGEXP :deliberation ORDER BY ID DESC');
      $req0->execute(array(
        ':datea'=>$this->getAnnee().'%',
        ':deliberation'=>str_replace(' ', '|', $this->getText())
      ));
    }

    $req1=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND communication LIKE :com ORDER BY ID DESC');
    $req1->execute(array(
      ':datea'=>$this->getAnnee().'%',
      ':com'=>'%'.str_replace(' ', '%', $this->getText()).'%'
    ));
    if($req1->rowCount()==0){
      $req1=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND communication REGEXP :com ORDER BY ID DESC');
      $req1->execute(array(
        ':datea'=>$this->getAnnee().'%',
        ':com'=>str_replace(' ', '|', $this->getText())
      ));
    }

    $req2=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND nomination LIKE :nom ORDER BY ID DESC');
    $req2->execute(array(
      ':datea'=>$this->getAnnee().'%',
      ':nom'=>'%'.str_replace(' ', '%', $this->getText()).'%'
    ));
    if($req2->rowCount()==0){
      $req2=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND nomination REGEXP :nom ORDER BY ID DESC');
      $req2->execute(array(
        ':datea'=>$this->getAnnee().'%',
        ':nom'=>str_replace(' ', '|', $this->getText())
      ));
    }

    $req3=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND content LIKE :content ORDER BY ID DESC');
    $req3->execute(array(
      ':datea'=>$this->getAnnee().'%',
      ':content'=>'%'.str_replace(' ', '%', $this->getText()).'%'
    ));
    if($req3->rowCount()==0){
      $req3=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND content REGEXP :content ORDER BY ID DESC');
      $req3->execute(array(
        ':datea'=>$this->getAnnee().'%',
        ':content'=>str_replace(' ', '|', $this->getText())
      ));
    }
    array_push($r, $req0);
    array_push($r, $req1);
    array_push($r, $req2);
    array_push($r, $req3);
    return $r;
  }

  public function searchTextMonthYear($bdd){
    $r=array();
    $req0=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND (deliberation LIKE :deliberation) ORDER BY ID DESC');
    $req0->execute(array(
      ':datea'=>$this->getAnnee().'-'.$this->getMois().'%',
      ':deliberation'=>'%'.str_replace(' ', '%', $this->getText()).'%'
    ));
    if($req0->rowCount()==0){
      $req0=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND deliberation REGEXP :deliberation ORDER BY ID DESC');
      $req0->execute(array(
        ':datea'=>$this->getAnnee().'-'.$this->getMois().'%',
        ':deliberation'=>str_replace(' ', '|', $this->getText())
      ));
    }


    $req1=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND communication LIKE :com ORDER BY ID DESC');
    $req1->execute(array(
      ':datea'=>$this->getAnnee().'-'.$this->getMois().'%',
      ':com'=>'%'.str_replace(' ', '%', $this->getText()).'%'
    ));
    if($req1->rowCount()==0){
      $req1=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND communication REGEXP :com ORDER BY ID DESC');
      $req1->execute(array(
        ':datea'=>$this->getAnnee().'-'.$this->getMois().'%',
        ':com'=>str_replace(' ', '|', $this->getText())
      ));
    }

    $req2=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND nomination LIKE :nom ORDER BY ID DESC');
    $req2->execute(array(
      ':datea'=>$this->getAnnee().'-'.$this->getMois().'%',
      ':nom'=>'%'.str_replace(' ', '%', $this->getText()).'%'
    ));
    if($req2->rowCount()==0){
      $req2=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND nomination REGEXP :nom ORDER BY ID DESC');
      $req2->execute(array(
        ':datea'=>$this->getAnnee().'-'.$this->getMois().'%',
        ':nom'=>str_replace(' ', '|', $this->getText())
      ));
    }


    $req3=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND content LIKE :content ORDER BY ID DESC');
    $req3->execute(array(
      ':datea'=>$this->getAnnee().'-'.$this->getMois().'%',
      ':content'=>'%'.str_replace(' ', '%', $this->getText()).'%'
    ));
    if($req3->rowCount()==0){
      $req3=$bdd->prepare('SELECT ID, title, datea FROM conseil WHERE datea LIKE :datea AND content REGEXP :content ORDER BY ID DESC');
      $req3->execute(array(
        ':datea'=>$this->getAnnee().'-'.$this->getMois().'%',
        ':content'=>str_replace(' ', '|', $this->getText())
      ));
    }

    array_push($r, $req0);
    array_push($r, $req1);
    array_push($r, $req2);
    array_push($r, $req3);
    return $r;
  }

  public function years($bdd){
    $req=$bdd->query('SELECT DISTINCT(SUBSTRING(datea, 1, 4)) as year FROM conseil');
    while($data=$req->fetch()){
      echo '<option>'.$data['year'].'</option>';
    }
  }

  public function months($bdd){
    echo '<option value="01">Janvier</option>';
    echo '<option value="02">Février</option>';
    echo '<option value="03">Mars</option>';
    echo '<option value="04">Avril</option>';
    echo '<option value="05">Mai</option>';
    echo '<option value="06">Juin</option>';
    echo '<option value="07">Juillet</option>';
    echo '<option value="08">Août</option>';
    echo '<option value="09">Septembre</option>';
    echo '<option value="10">Octobre</option>';
    echo '<option value="11">Novembre</option>';
    echo '<option value="12">Décembre</option>';
  }

  public function breakDown($bdd, $year){
    $i;
    $delib = array(); $nom=array(); $com = array();
    for($i=1; $i<=+12; $i++){
      $req=$bdd->prepare('SELECT count(*) as delib,
        (SELECT count(*) FROM conseil WHERE nomination!="" AND substr(datea, 6,7) like :month AND substr(datea,1,4)=:year) as nom,
        (SELECT count(*) FROM conseil WHERE communication!="" AND substr(datea, 6,7) like :month AND substr(datea,1,4)=:year) as com
        FROM conseil WHERE deliberation!="" AND substr(datea, 6,7) like :month AND substr(datea,1,4)=:year');
        $req->execute(array(
          ':month'=>str_pad($i, 2, "0", STR_PAD_LEFT).'%',
          ':year'=>$year
        ));

        $ctrs=$req->fetch();
        array_push($delib, $ctrs['delib']);
        array_push($nom, $ctrs['nom']);
        array_push($com, $ctrs['com']);
    }
    echo json_encode(array('delib'=>$delib, 'nom'=>$nom, 'com'=>$com));
  }

  public function getYears($bdd){
    $y=array();
    $req=$bdd->query('SELECT DISTINCT(SUBSTRING(datea, 1, 4)) as year FROM conseil');
    while($data=$req->fetch()){
      array_push($y, $data['year']);
    }
    return $y;
  }

  public function getLastYear($bdd){
    $req=$bdd->query('SELECT DISTINCT(SUBSTRING(datea, 1, 4)) as year FROM conseil WHERE ID=(SELECT MAX(ID) FROM conseil)');
    $d=$req->fetch();
    return $d['year'];
  }

}

?>
