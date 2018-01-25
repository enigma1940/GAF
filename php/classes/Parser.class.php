<?php
class Parser{
  private $text;
  public function setText($i){$this->text=$i;}
  public function getText(){return $this->text;}
  public function treat(){
    $matches;
    preg_match_all('#<p>(.*)</p>#Us', $this->text, $matches);
    /*foreach($matches as $value){
      foreach ($value as $val) {
        if(preg_match('#d[eé]liberation[*]$#i', $val)){
          $val=str_replace($val, '<font id="deliberation">'.$val.'</font>', $val);
        }
        if(preg_match('#communication orale$#i', $val)){
          $val=str_replace($val, '<font id="communication">'.$val.'</font>', $val);
        }
        if(preg_match('#nomination$#i', $val)){
          $val=str_replace($val, '<font id="nomination">'.$val.'</font>', $val);
        }
      }
    }*/
    echo $this->getText();
  }

}

?>
