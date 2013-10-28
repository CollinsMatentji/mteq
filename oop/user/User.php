<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author m
 */
class User {
    //put your code here
    var $u_id;
    var $u_mail;
    var $u_pass;
    var $u_role;
    var $u_fname;
    var $u_lname;
    var $u_tel;
    var $u_address;
    var $item;
    public function register($u_mail, $u_pass, $u_role, $u_fname, $u_lname, $u_tel, $u_address){
        $db_man = new DBMan();
        $query = "insert into user values('$u_mail', '$u_pass', '$u_role', '$u_fname', '$u_lname', '$u_tel', '$u_address','Yes')";
        if(!$this->isUserNameTaken($u_mail)){
            $db_man->send_query($query);
        }
        if(mysql_affected_rows() > 0){
            ?>
            <script type="" language="javascript">
                alert("Sign Up Successful you can now Sign in using your E-mail  and Password!");
            </script>
            <?php
            return mysql_affected_rows();
        }
    }
    public function login($u_mail, $u_pass){
       $query = "select * from user where u_mail = '$u_mail' and u_pass ='$u_pass'";
       $db_man = new DBMan();
       $s_man = new SessionMan();
       $result = $db_man->send_query($query);
       if(mysql_affected_rows() > 0){
           $user = mysql_fetch_array($result);
           $s_man->set_session_user($user);
           header("location:index.php");
       }
       else{
           $_SESSION['err'] = "Invalid login details!";
       }
    }
    function isUserLoged(){
        if(!isset ($_COOKIE['u_mail'])){
            header("location:index.php");
        }
        else {
            return true;
        }
    }
    function isAdminLoged(){
        if($this->isUserLoged()){
            if($_COOKIE['u_role'] != "admin"){
                header("location:index.php");
            }
            else{
                return true;
            }
        }
    }
    public function logout(){
        $s_man = new SessionMan();
        $s_man->unset_session_user();
        header("location:index.php");
    }
    public function requestPass($u_mail){
       $query = "select U_PASS, U_LNAME, U_FNAME from user where U_MAIL = '$u_mail'";
       $db_man = new DBMan();
       $result = $db_man->send_query($query);
       if(mysql_affected_rows() > 0){
           $user = mysql_fetch_array($result);
           return $user;
       }
       else{
           $_SESSION['err'] = "Invalid e-mail or username!";
       }
    }
    public function updateAccount($index, $value,$u_pass){
       if($index == "a_line1" || $index == "a_line2" || $index == "ap_code"){
           $value = $this->setAddress($index, $value);
           $index = 'u_address';
       }
       $u_mail = $_COOKIE['u_mail'];
       $query = "update user set $index='$value' where U_MAIL='$u_mail'";
       $db_man = new DBMan();
       if($u_pass == $_COOKIE['u_pass']){
           $result = $db_man->send_query($query);
           if(mysql_affected_rows() > 0){
               $user = array($index=>$value);
               setcookie($index,$value);
               header("location:account.php?&changed=yes");
           }
       }
       else {
           header("location:account.php?&changed=no");
       }
    }
    public function viewCat($b_name,$i_sex){
       $query = "select * from item where I_CAT = '$b_name' and I_SELL = 'yes' and I_SEX ='$i_sex'";
       if($i_sex == "All Genders"){
           $query = "select * from item where I_CAT = '$b_name' and I_SELL = 'yes'";
       }
       if(isset ($_COOKIE['u_mail'])){
           if($_COOKIE['u_role'] == 'admin'){
              $query = "select * from item where I_CAT = '$b_name' and I_SEX ='$i_sex'";
              if($i_sex == "All Genders"){
                  $query = "select * from item where I_CAT = '$b_name'";
              }
           }
       }
       $db_man = new DBMan();
       $result = $db_man->send_query($query);
       $i = 0;
       $x = 5;
       echo "<table border='0' width='935' style='margin: 10px 0px 0px 0px'><tr>";
       $role = "u_role";
       if(isset ($_COOKIE['u_mail'])){
           $role  = $_COOKIE['u_role'];
       }
       while ($item = mysql_fetch_array($result)){
           if(($item['I_QTY'] > 0 && $role == 'buyer') || (!isset ($_COOKIE['u_mail']) && $item['I_QTY'] > 0) || ($role == "admin" && isset ($_COOKIE['u_mail']))){
               if($i == $x){
                   echo "</tr><tr>";
                   $x = $x + 6;
               }
               echo "<td align='center' valign='middle'><div class='item'>
                     <a href='catalouge.php?&name=".$item['B_NAME']."&model=".$item['I_MODEL']."&op=view' title='View item details'>
                        <img src='img/item/".$item['I_PIC'].".png' height='170' width='150'>
                     </a><br /><b>".$item['B_NAME'].":</b>&nbsp;".$item['I_MODEL']."
                     <br>For ".$item['I_SEX'];
               if(isset ($_COOKIE['u_mail'])){
                    echo "@R".$item['I_PRICE']."<br />";
                    if($item['I_QTY'] > 0){
                        echo "<b id='on_shelf'>".$item['I_QTY']." items<br />";
                        echo "<a href='catalouge.php?&cat=".$item['B_NAME']."&model=".$item['I_MODEL']."&op=add_to_cart' title='Add this item to cart'>Add to card</a>";
                    }
                    else{
                        echo "<b id='off_shelf'>".$item['I_QTY']." items<br />Add to card";
                    }
               }
               else{
                   if($item['I_QTY'] > 0){
                       echo "<br /><b id='on_shelf'>".$item['I_QTY']." items</b><br />";
                       echo "<a href='sign_up.php' title='Buy this item'>Buy</a>";
                   }
                   else{
                       echo "<br /><b id='off_shelf'>".$item['I_QTY']." items<br />";
                       echo "Buy</b>";
                   }
                   echo " @R".$item['I_PRICE'];
               }
               echo "</div></td>";
               $i++;
           }
       }
       echo "</tr></table>";
    }
    function viewItem($b_name,$i_model){
       $query = "select * from item where B_NAME = '$b_name' and I_MODEL = '$i_model'";
       $db_man = new DBMan();
       $result = $db_man->send_query($query);
       $item = mysql_fetch_array($result);
       $action = $this->detFormAction($item);
       $item_obj = new Item('','', '', '', '', '', '', '', '');
       $i_buy = $item_obj->calcItemBuys($b_name, $i_model);
       echo "<form id='item_form' method='post' name='item_form' enctype='multipart/form-data' action='$action'><table align='center' border='0' width='100%'>
             <tr><td width='35%' valign='top'>";
       $i_pic = $item['I_PIC'];
       echo "<div class='mitem'><img src='img/item/".$item['I_PIC'].".png'id='img_preview' height='290' width='250'></div>";
       echo "</td>";
       if($_GET['op'] != "edit_det" ){
            echo "<td valign='top'><b>Item descrption:</b> ".$item['I_DESC']."<br /><b>Price</b> R".$item['I_PRICE']."<br />".
                  "<b>Designed for:</b> ".$item['I_SEX']."<br />";
            if($item['I_SELL'] == "no"){
               echo "<br /><b id='off_shelf'>".$item['I_QTY']." items off shelf</b><br />";
           }
           else{
               if($item['I_QTY'] != 0){
                   echo "<br /><b id='on_shelf'>".$item['I_QTY']." items on shelf</b><br />";
               }
               else{
                   echo "<br /><b id='off_shelf'>".$item['I_QTY']." items on shelf</b><br />";
               }
               echo "<br /><b>".$i_buy." buys</b><br />";
           }
       }
       else if ($_GET['op'] == "edit_det"){
            echo "<td valign='top'><b>Item descrption:</b><br />
                  <textarea name='i_desc' rows='4' cols='23' valign='top' >".$item['I_DESC']."</textarea><br />
                  <br /><b>Price:</b> R<input type='text' value='".$item['I_PRICE']."'  name='i_price' size='10' style='padding-top:3px'/><br />".
                 "<br /><b>Designed for:</b><br />";
            $this->selectSex($item['I_SEX']);
            echo '<br/><b>Change image:</b><br />';
            echo '<input type="file" name="ni_pic" id="i_pic" style="width: 202px;" />';
            echo "<br/><b id='err'>".$_SESSION['err']."</b><br/><input type='submit' value='Save' name='save_item'style='width:65px'>
                  <input type='submit' name='cancel_edit' value='Cancel'>";
            echo "<input type='hidden' name='i_pic' value='".$item['I_PIC']."'>";
       }
       if(isset ($_COOKIE['u_mail'])){
            if($_GET['op'] != 'edit_det' && $_GET['op'] != 'insert_item'){
                if($item['I_SELL'] != "no" ){
                    echo "<br /><a href='catalouge.php?&cat=".$item['B_NAME']."&model=".$item['I_MODEL']."&op=add_to_cart' title='Add this item to cart'>Add to card</a>";
                }
            }
            if($_COOKIE['u_role'] == "admin"){
                 if($_GET['op'] == 'insert_item'){
                    echo "<br />Enter number of items: <input type='text' size='15' name='i_num'>
                          <br /><br /><input type='submit' name='insert_item' value='Insert' style='width:65px'> <input type='submit' value='Cancel'>";
                 }
                 echo "</td><td valign='top' width='15%'><b>Admin</b><br />
                       <a href='catalouge.php?&name=".$item['B_NAME']."&model=".$item['I_MODEL']."&op=edit_det' title='Edit item details'>[Edit details]</a><br />";
                 echo "<a href='catalouge.php?&name=".$item['B_NAME']."&model=".$item['I_MODEL']."&qty=".$item['I_QTY']."&op=insert_item' title='Insert items in item'>[Insert items]</a><br />";
                 if($item['I_SELL'] != "no"){
                    echo "<a href='catalouge.php?&name=".$item['B_NAME']."&model=".$item['I_MODEL']."&op=remove_on_shelf' title='Temoporarly remove item from shelf'>[Remove from shelf]</a>";
                  }
                 else{
                    echo "<a href='catalouge.php?&name=".$item['B_NAME']."&model=".$item['I_MODEL']."&op=place_on_shelf'>[Place on shelf]</a>";
                 }
           }
        }
        else{
            echo "<br /><a href='sign_up.php' title='Buy this item'>Buy</a>";
        }
        echo "</td>";
        echo "</tr></table></form>";
    }
    private function setAddress($index, $value){
        $address = explode('-',$_COOKIE['u_address']);
        if($index == "a_line1"){
            return $value."-".$address[1]."-".$address[2];
        }
        else if($index == "a_line2"){
            return $address[0]."-".$value."-".$address[2];
        }
        else if($index == "ap_code"){
            return $address[0]."-".$address[1]."-".$value;
        }
    }
    private function isUserNameTaken($u_mail){
       $query = "select U_MAIL from user where U_MAIL = '$u_mail'";
       $db_man = new DBMan();
       $result = $db_man->send_query($query);
       if(mysql_affected_rows() > 0){
           throw new Exception("<div class='exception'><b>The e-mail you entered has been registered by another user</b></div>");
       }
       else{
           return false;
       }
    }
    private function selectSex($i_sex){
        if($i_sex == "men and ladies"){
            echo '<input type="radio" name="i_sex" checked="" value="men and ladies"/>Men and Ladies<br />
                  <input type="radio" name="i_sex" value="men" />Men <br />
                  <input type="radio" name="i_sex" value="ladies" />Ladies <br />';
       }
       else if($i_sex == "men"){
            echo '<input type="radio" name="i_sex" value="men and ladies"/>Men and Ladies<br />
                  <input type="radio" name="i_sex" checked="" value="men" />Men <br />
                  <input type="radio" name="i_sex" value="ladies" />Ladies <br />';
       }
       else if($i_sex == "ladies"){
            echo '<input type="radio" name="i_sex" value="men and ladies"/>Men and Ladies<br />
                  <input type="radio" name="i_sex" value="men" />Men <br />
                  <input type="radio" name="i_sex" checked="" value="ladies" />Ladies <br />';
       }
       else{
           echo '<input type="radio" name="i_sex" value="men and ladies"/>Men and Ladies<br />
                  <input type="radio" name="i_sex" checked="" value="men" />Men <br />
                  <input type="radio" name="i_sex" value="ladies" />Ladies <br />';
       }
    }
    private function detFormAction($item){
        if(isset ($_GET['op'])){
            if($_GET['op'] == 'edit_det'){
                return "catalouge.php?&name=".$item['B_NAME']."&model=".$item['I_MODEL']."&op=edit_det";
            }
            else if($_GET['op'] == 'insert_item'){
                 return "catalouge.php?&name=".$item['B_NAME']."&model=".$item['I_MODEL']."&qty=".$item['I_QTY']."&op=insert_item";
            }
        }
    }
}
?>