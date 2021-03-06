<?php
  class PaginatorL{
    public $cat, $pages;
    public function __construct(){}
    
      public function NbreArticlesParPage()
      {
          $nbre_articles_par_page = 6;
          return $nbre_articles_par_page;
      }
      
      public function NbrePages($bdd)
      {
          $re=$bdd->prepare('SELECT COUNT(*) AS m FROM loi');
          $re->execute();
          $d = $re->fetch();
          return ceil($d['m']/$this->NbreArticlesParPage());
      }
      
      public function PageActive($bdd)
      {
          if(isset($_GET['pagel']) && is_numeric($_GET['pagel']))
          {
            $page_num = $_GET['pagel'];
          }
          else
          {
            $page_num = 1;
          }

          if($page_num < 1)
          {
            $page_num=1;
          }
          else if($page_num>$this->NbrePages($bdd))
          {
            $page_num = $this->NbrePages($bdd);
          }
          
          return $page_num;
      }
      
      public function pageArea($bdd)
      { 
            $nbre_articles_max_avant_et_apres = 4;
            $pagination = " ";
        
            if($this->NbrePages($bdd) != 1)
            {
                if($this->PageActive($bdd) > 1)
                {
                    $previous = $this->PageActive($bdd) - 1;
                    $pagination .= '<a href="index.php?pagel='.$previous.'#articlesL"><font color="firebrick"><i class="icon icon-chevron-left icon-lg"></i></font></a>&nbsp;';
                    
                    for($i = $this->PageActive($bdd) - $nbre_articles_max_avant_et_apres; $i < $this->PageActive($bdd) ; $i++)
                    {
                        if($i > 0)
                        {
                            $pagination .= '<a href="index.php?pagel='.$i.'#articlesL" class="aPage">'.$i.' </a>&nbsp;';
                        }
                    }
                }
            }
        
            $pagination .= '<span class="actif">'.$this->PageActive($bdd).'</span>&nbsp;';
        
            for($i=$this->PageActive($bdd)+1;$i<=$this->NbrePages($bdd);$i++)
            {
                $pagination .= '<a href="index.php?pagel='.$i.'#articlesL" class="aPage">'.$i.' </a>&nbsp;';
                
                if($i >= $this->PageActive($bdd) + $nbre_articles_max_avant_et_apres)
                {
                    break;
                }
            }
        
            if($this->PageActive($bdd) != $this->NbrePages($bdd))
            {
                $next = $this->PageActive($bdd) + 1;
                $pagination .= '&nbsp;<a href="index.php?pagel='.$next.'#articlesL"><font color="firebrick"><i class="icon icon-chevron-right icon-lg"></i></font></a>&nbsp;';
            }
        
            echo "<div>".$pagination."</div>";
      }
  }
?>
<style>
  .aPage{padding: 10px; background: #ccc; border-radius: 5px; margin-left: 5px; cursor: pointer; color: black;}
  .actif{padding: 10px; background:firebrick; border-radius: 5px; margin-left: 5px; cursor: pointer; color: black;}
</style>