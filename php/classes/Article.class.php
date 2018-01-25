<?php
  class Article{
    private $title, $content, $datea, $id, $deliberation, $nomination, $communication;
    public function setTitle($t){$this->title=$t;}
    public function setContent($c){$this->content=$c;}
    public function setDatea($d){$this->date=$d;}
    public function setId($i){$this->id=$i;}
    public function setDeliberation($i){$this->deliberation=$i;}
    public function setNomination($i){$this->nomination=$i;}
    public function setCommunication($i){$this->communication=$i;}

    public function getTitle(){return $this->title;}
    public function getContent(){return $this->content;}
    public function getDatea(){return $this->date;}
    public function getId(){return $this->id;}
    public function getDeliberation(){return $this->deliberation;}
    public function getNomination(){return $this->nomination;}
    public function getCommunication(){return $this->communication;}

    public function __construct(){}

    public function hydrate(array $d){
      foreach ($d as $key => $value) {
        $method = 'set'.ucfirst($key);
        if(method_exists($this, $method)){
          $this->$method($value);
        }
      }
    }

    public function read($bdd){
      $req=$bdd->prepare('SELECT * FROM conseil WHERE ID=?');
      $req->execute(array($this->getId()));
      while($data=$req->fetch(PDO::FETCH_ASSOC)){
        $this->hydrate($data);
      }
    }
    
  }
?>
