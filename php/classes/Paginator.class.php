<?php
  class Paginator{
    public $cat, $page;
    public function __construct(){}
    public function maxnum($bdd){
      $re=$bdd->prepare('SELECT COUNT(*) AS m FROM article WHERE cat=?');
      $re->execute(array($this->cat));
      $d = $re->fetch();
      return ceil($d['m']/12);
    }
    public function page($bdd){
      $i;
      /*if($this->maxnum($bdd)-$this->page+10<10){
        $this->page=$this->page-($this->maxnum($bdd)-$this->page+10);
      }*/
      $m = $this->page+10;
      echo '<font class="begin">Début</font>';
      echo '<font class="prec">Précédent</font>';
      for($i=$this->page; $i<$m; $i++){
        if($i<$this->maxnum($bdd)){
          if($i==$this->page){
            echo '<font class="aPage" style="padding: 10px; background: rgb(0, 156, 233); margin-right: 4px; display: inline-block; cursor: pointer;">'.$i.'</font>';
          }
          else echo '<font class="aPage">'.$i.'</font>';
        }else{
          //echo '</font></font>';
        }
      }
      echo '<font class="next">Suivant</font>';
      echo '<font class="end">Fin</font>';
      echo '<input type="hidden" class="ctPage" value="'.$this->maxnum($bdd).'" />';
    }
    public function lastPage($bdd){
      $this->page=$this->maxnum($bdd)-10;
      $this->page($bdd);
    }
  }
?>
<style>
  .aPage{padding: 10px; background: #ccc; margin-right: 4px; display: inline-block; cursor: pointer;}
  .begin, .end, .prec, .next{padding: 10px; background: #fc0; margin-right: 4px; display: inline-block; cursor: pointer;}
</style>
<script></script>
