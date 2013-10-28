<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Buyer
 *
 * @author m
 */
class Buyer {
    //put your code here
    function addCardItem ($u_mail, $b_name, $i_model){
        $db_man = new DBMan();
        $p_num = $this->purchaseNum($u_mail);
        $item =  $this->isItemOncard($u_mail, $b_name, $i_model);
        if($item['P_NUM'] == 0){
            $query = "insert into cart values('$u_mail','$b_name','$i_model',1,$p_num)";
        }
        else{
            $c_qty = $item['C_QTY'] + 1;
            $query = "update cart set C_QTY = '$c_qty' where B_NAME = '$b_name' and I_MODEL = '$i_model' and P_NUM = ".$item['P_NUM']."";
        }
        $db_man->send_query($query);
        $s_man = new SessionMan();
        $s_man->set_session_buyer($_COOKIE['u_mail']);
        header('location:http:cart.php?');
    }
    function getCart($u_mail, $p_status){
        $db_man = new DBMan();
        $query = "SELECT cart.B_NAME, cart.I_MODEL, item.I_PRICE, C_QTY, I_PIC, I_QTY, I_SELL, purchase.P_NUM, P_DATE, U_MAIL
                       FROM cart, item, purchase
                       WHERE cart.P_NUM = purchase.P_NUM and cart.I_MODEL = item.I_MODEL and cart.U_MAIL = '$u_mail' and P_STATUS= '$p_status'
                       ORDER by purchase.P_NUM";
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
    function removeCardItem ($u_mail, $b_name, $i_model){
        $db_man = new DBMan();
        $item =  $this->isItemOncard($u_mail, $b_name, $i_model);
        $query = "delete
                  from cart
                  where U_MAIL = '$u_mail' and B_NAME = '$b_name' and I_MODEL = '$i_model' and P_NUM = ".$item['P_NUM'];
        $result = $db_man->send_query($query);
        $s_man = new SessionMan();
        $s_man->set_session_buyer($_COOKIE['u_mail']);
        header('location:http:cart.php?');
    }
    function minusCardItem($u_mail,$b_name,$i_model){
        $db_man = new DBMan();
        $item =  $this->isItemOncard($u_mail, $b_name, $i_model);
        $c_qty = $item['C_QTY'] - 1;
        $query = "update cart set C_QTY = '$c_qty' where B_NAME = '$b_name' and I_MODEL = '$i_model' and P_NUM = ".$item['P_NUM']."";
        if($item['C_QTY'] == 1){
            $this->removeCardItem($u_mail, $b_name, $i_model);
        }
        $db_man->send_query($query);
        $s_man = new SessionMan();
        $s_man->set_session_buyer($_COOKIE['u_mail']);
        header('location:http:cart.php?');
    }
    function checkOut($u_mail,$_subsc){
        $db_man = new DBMan();
        $p_num = $this->getPurchaseNum($u_mail);
        $query = "update purchase set P_STATUS = 'started', P_DATE ='".date('Y-m-d H:i:00')."' where P_NUM = $p_num;";
        if($_subsc == 'Yes'){
            $db_man->send_query($query);
            $sign = "-";
            $this->updateItemQTY($p_num,$sign);
            $s_man = new SessionMan();
            $s_man->set_session_buyer($_COOKIE['u_mail']);
            header("location:purchase.php?");
        }
        else if($_subsc == 'No'){
            ?>
            <script type="" language="javascript">
                alert("Purchase not successful, user unsubscribed! \nContact Help Center: 0861 925 102");
            </script>
            <?php
        }
    }
    function calcPurcahseExp($time){
        $timeStampArr = explode(' ', $time);
        $c_time = explode(':', $timeStampArr[1]);
        $minute = $c_time[1] + 10;
        $hour = $c_time[0];
        if($minute > 59){
            $minute = (60 - $minute) * -1;
            if($minute < 10){
                $minute = "0".$minute;
            }
            $hour = $c_time[0] + 1;
            if($hour > 23){
                $hour = "00";
            }
        }
        return $timeStampArr[0]." ".$hour.":".$minute;
    }
    function cancelPurchase($p_num){
        $db_man = new DBMan();
        $query = "UPDATE
                  purchase set P_STATUS = 'cancelled'
                  WHERE P_NUM = $p_num";
        $result = $db_man->send_query($query);
        $sign = "+";
        $this->updateItemQTY($p_num,$sign);
    }
    function expirePurchase($ex_time,$p_num){
        $db_man = new DBMan();
        $query = "UPDATE
                  purchase set P_STATUS = 'expired'
                  WHERE P_NUM = $p_num and P_STATUS = 'started'";
        if(strtotime('now') > strtotime($ex_time)){
            $db_man->send_query($query);
        }
    }
    function purchase($date){
       $db_man = new DBMan();
        $query = "UPDATE
                  purchase set P_STATUS = 'completed'
                  WHERE P_DATE = '$date'";
        $db_man->send_query($query);
    }
    private function updateItemQTY($p_num, $sign){
        $db_man = new DBMan();
        $query = "select B_NAME, I_MODEL from cart where P_NUM = $p_num";
        $result = $db_man->send_query($query);
        while($item = mysql_fetch_array($result)){
            $b_name = $item['B_NAME'];
            $i_model = $item['I_MODEL'];
            $query = "update item set I_QTY = (I_QTY $sign (select C_QTY from cart where P_NUM = $p_num and  B_NAME = '$b_name' and I_MODEL = '$i_model')) where B_NAME = '$b_name'and I_MODEL = '$i_model'";
            $db_man->send_query($query);
        }
    }
    private function purchaseNum($u_mail){
        $db_man = new DBMan();
        $query = "select cart.P_NUM
                  from cart, purchase
                  where cart.P_NUM = purchase.P_NUM and U_MAIL = '$u_mail' and P_STATUS = 'pending'";
        $result = $db_man->send_query($query);
        if(mysql_affected_rows() > 0){
            $p_num = mysql_fetch_array($result);
            return $p_num['P_NUM'];
        }
        else{
            $query = "insert into purchase (P_NUM, P_STATUS)values(null, 'pending')";
            $result = $db_man->send_query($query);
            return mysql_insert_id();
        }
    }
    private function isItemOncard($u_mail, $b_name, $i_model){
        $db_man = new DBMan();
        $query = "SELECT cart.C_QTY, cart.P_NUM
                       FROM cart, purchase
                       WHERE cart.P_NUM = purchase.P_NUM and B_NAME = '$b_name' and I_MODEL = '$i_model' and U_MAIL = '$u_mail' and  P_STATUS= 'pending'";
        $result = $db_man->send_query($query);
        if(mysql_affected_rows() > 0){
            $item = mysql_fetch_array($result);
            return $item;
        }
        else{
            return array('C_QTY'=>0, 'P_NUM'=>0);
        }
    }
    private function getPurchaseNum($u_mail){
        $db_man = new DBMan();
        $query = "select cart.P_NUM
                  from cart, purchase
                  where cart.P_NUM = purchase.P_NUM and U_MAIL = '$u_mail' and P_STATUS = 'pending'";
        $result = $db_man->send_query($query);
        if(mysql_affected_rows() > 0){
            $p_num = mysql_fetch_array($result);
            return $p_num['P_NUM'];
        }
    }
}
?>
