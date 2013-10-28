<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author m
 */
class Admin {
    //put your code here
    var $item;
    var $b_name;

    function addBrand($b_name){
        $db_man = new DBMan();
        echo $query = "insert into brand values('$b_name')";
        $db_man->send_query($query);
    }
    function addItem($item){
        $db_man = new DBMan();
        echo $query = "insert into item values('".$item['i_cat']."','".$item['b_name']."','".$item['i_model']."', '".$item['i_desc']."', '".$item['i_price']."', '".$item['i_pic']."',
                                          '".$item['i_sex']."', 'yes','".$item['i_qty']."')";
        $db_man->send_query($query);
        if(mysql_affected_rows() > 0){
            header("location:catalouge.php?&name=".$item['b_name']."&model=".$item['i_model']."&op=view");
        }
    }
    function editItem($item){
        $db_man = new DBMan();
        echo $query = "update item set I_DESC='".$item['i_desc']."', I_PRICE='".$item['i_price']."', I_PIC='".$item['i_pic']."',
                       I_SEX='".$item['i_sex']."', I_QTY='".$item['i_qty']."'
                       where B_NAME='".$item['b_name']."' and I_MODEL='".$item['i_model']."'";
        $db_man->send_query($query);
        if(mysql_affected_rows() > 0 || $_COOKIE['err'] == "Notice: No file uploaded"){
            header("location:catalouge.php?&name=".$_GET['name']."&model=".$_GET['model']."&op=view");
        }
    }
    function minusShelfItem($b_name, $i_model){
        $db_man = new DBMan();
        $query = "update item set I_SELL='no' where B_NAME='$b_name' and I_MODEL='$i_model'";
        $db_man->send_query($query);
    }
    function addShelfItem($b_name, $i_model){
        $db_man = new DBMan();
        $query = "update item set I_SELL='yes' where B_NAME='$b_name' and I_MODEL='$i_model'";
        $db_man->send_query($query);
    }
    function insertItem($b_name, $i_model,$i_qty,$i_num){
       $db_man = new DBMan();
       $ni_qty = $i_qty + $i_num;
       $query = "update item set I_QTY='$ni_qty' where B_NAME='$b_name' and I_MODEL='$i_model'";
       $db_man->send_query($query);
       if(mysql_affected_rows() > 0){
            header("location:catalouge.php?&name=".$_GET['name']."&model=".$_GET['model']."&op=view");
        }
    }
    function getPurchase($p_status,$p_month){
        $db_man = new DBMan();
        $query = "SELECT cart.B_NAME, cart.I_MODEL, item.I_PRICE, C_QTY, I_PIC, I_QTY, I_SELL, purchase.P_NUM, P_DATE, U_LNAME, U_FNAME
        FROM cart, item, purchase, user
        WHERE cart.P_NUM = purchase.P_NUM and cart.I_MODEL = item.I_MODEL and P_STATUS= '$p_status' and cart.U_MAIL = user.U_MAIL ";
        if($p_status != 'Started' && $p_status != 'Pending'){
            $query.=" and SUBSTRING(P_DATE, 1, 7) = '$p_month'";
        }
        $query.=" ORDER by purchase.P_NUM";
        $result = $db_man->send_query($query);
        $cart = array();
        if(mysql_affected_rows() > 0){
            $i = 0;
            while($item = mysql_fetch_array($result)){
                if(!in_array($item, $cart)){
                    $cart[$i] = $item;
                    $i++;
                }
            }
        }
        return $cart;
    }
    function completePurchase($p_num){
        $db_man = new DBMan();
        $query = "UPDATE purchase
                  set P_STATUS = 'completed' where P_NUM = '$p_num'";
        $result = $db_man->send_query($query);
    }
    function getAllUsers(){
        $db_man = new DBMan();
        $query = "SELECT U_FNAME, U_LNAME, U_MAIL, U_ROLE, U_TEL, U_ADDRESS, U_SUBSC 
        FROM user";
       
        $result = $db_man->send_query($query);
        $users = array();
        if(mysql_affected_rows() > 0){
            $i = 0;
            while($user = mysql_fetch_array($result)){
                if(!in_array($user, $users)){
                    $users[$i] = $user;
                    $i++;
                }
            }
        }
        return $users;
    }
    function unsubscribeUser($u_mail){
        $db_man = new DBMan();
        $query = "UPDATE user
                  set U_SUBSC = 'No' where U_MAIL = '$u_mail'";
        $result = $db_man->send_query($query);
    }
    function subscribeUser($u_mail){
        $db_man = new DBMan();
        $query = "UPDATE user
                  set U_SUBSC = 'Yes' where U_MAIL = '$u_mail'";
        $result = $db_man->send_query($query);
    }
}
?>