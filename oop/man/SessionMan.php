<?php
$_SESSION['err']='';
class SessionMan{
    function set_session_user($user){
        $_SESSION['u_mail'] = $user['U_MAIL'];
        $_SESSION['u_pass'] = $user['U_PASS'];
        $_SESSION['u_fname'] = ucfirst(strtolower($user['U_FNAME']));
        $_SESSION['u_lname'] = ucfirst(strtolower($user['U_LNAME']));
        $_SESSION['u_role'] = $user['U_ROLE'];
        $_SESSION['u_tel']  = $user['U_TEL'];
        $_SESSION['u_subsc']  = $user['U_SUBSC'];
        $_SESSION['u_address']  = $user['U_ADDRESS'];
        $this->set_session_buyer($_SESSION['u_mail']);
        setcookie('u_mail',$_SESSION['u_mail']);
        setcookie('u_pass',$_SESSION['u_pass']);
        setcookie('u_lname',$_SESSION['u_lname']);
        setcookie('u_fname',$_SESSION['u_fname']);
        setcookie('u_role',$_SESSION['u_role']);
        setcookie('u_tel',$_SESSION['u_tel']);
        setcookie('u_subsc',$_SESSION['u_subsc']);
        setcookie('u_address',$_SESSION['u_address']);
   }
   function set_session_buyer($u_mail){
       if(isset ($u_mail)){
            setcookie('b_item',$this->calcItem($u_mail));
            setcookie('b_amnt',$this->calcAmnt($u_mail));
       }
       else{
           $_SESSION['b_item'] = 0;
           setcookie('b_item',$_SESSION['b_item']);
       }
   }
   function  unset_session_user()
   {
       unset ($_SESSION['u_mail']);
       setcookie('u_mail','',time()-3600);
       session_destroy();
   }
   private function calcItem($u_mail){
       $buyer = new Buyer();
       $item = 0;
       $cart = $buyer->getCart($u_mail,'pending');
       foreach ($cart as $c) {
           $item = $item + $c['C_QTY'];
       }
       return $item;
   }
   private function calcAmnt($u_mail){
       $buyer = new Buyer();
       $amnt = 0;
       $cart = $buyer->getCart($u_mail,'pending');
       foreach ($cart as $c) {
           $amnt = $amnt + ($c['I_PRICE'] * $c['C_QTY']);
       }
       return $amnt;
   }
}
?>