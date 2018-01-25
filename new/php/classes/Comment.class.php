<?php
  class Comment{
    private $id, $uname, $article, $content, $mail, $date;

    public function getId(){return $this->id;}
    public function getUname(){return $this->uname;}
    public function getArticle(){return $this->artid;}
    public function getContent(){return $this->content;}
    public function getMail(){return $this->mail;}
    public function getDate(){return $this->date;}

    public function setId($i){$this->id=$i;}
    public function setUname($i){$this->uname=$i;}
    public function setArticle($i){$this->artid=$i;}
    public function setContent($i){$this->content=$i;}
    public function setMail($i){$this->mail=$i;}
    public function setDate($i){$this->date=$i;}

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
        $req=$bdd->prepare('SELECT * FROM comment WHERE id=?');
        $req->execute(array($this->getId()));
      }
      public function create($bdd){
        $req=$bdd->prepare('INSERT INTO comment(uname, content, article, mail) VALUES(:uname, :content, :article, :mail)');
        $req->execute(array(
          ':uname'=>$this->getUname(),
          ':content'=>$this->getContent(),
          ':article'=>$this->getArticle(),
          ':mail'=>$this->getMail()
        ));
      }
  }
?>
