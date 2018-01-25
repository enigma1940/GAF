<?php
  class Loi{
    private $title, $filelink, $id;
    public function __construct(){}
    public function getTitle(){return $this->title;}
    public function getFilelink(){return $this->filelink;}
    public function getId(){return $this->id;}

    public function setTitle($i){$this->title=$i;}
    public function setFilelink($i){$this->filelink=$i;}
    public function setId($id){$this->id=$id;}

    public function hydrate(array $d){
      foreach ($d as $key => $value) {
        $method = 'set'.ucfirst($key);
        if(method_exists($this, $method)){
          $this->$method($value);
        }
      }
    }
?>
