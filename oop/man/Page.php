<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page
 *
 * @author m
 */
if(!isset ($_COOKIE)){
    session_start();
}
if(!isset ($_SESSION)){
    session_start();
}
class Page {
    //put your code here
    function title($title){
        foreach ($this->getPage() as $t=>$p) {
            if(strtolower($title) == strtolower($t)) {
                echo "M-teQ - ".$t;
            }
        }
    }
    function CatLink(){
       $catLinks = array('Laptops','Modems','Ipods');
       foreach ($catLinks as $catLink) {
           echo '<a href="catalouge.php?&cat='.$catLink.'" title="Browse '.$catLink.' items">'.$catLink.'</a>&nbsp;&nbsp;&nbsp;';
       }
    }
    function header($title){
        include 'include/header.php';
    }
    function content($title){
         foreach ($this->getPage() as $t=>$p) {
            if(strtolower($title) == strtolower($t)) {
                include 'include/content/'.$p;
            }
        }
    }
    function footer(){
         include 'include/footer.php';
    }
    private function getPage(){
        return array("Welcome"=>"index.php","About us"=>"about.php","Contact us"=>"contact.php","Sign In or Sign up"=>"sign_up.php",
                     "Account"=>"account.php","Watches"=>"catalouge.php","Admin"=>"admin.php","Cart"=>"cart.php", "Purchase"=>"purchase.php","Search"=>"search.php");
    }
}
?>
