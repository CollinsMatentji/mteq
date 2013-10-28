<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Item
 *
 * @author m
 */
class Item {
    //put your code here
    var $b_name;
    var $i_model;
    var $i_price;
    var $i_pic;
    var $i_desc;
    var $i_sex;
    var $i_qty;
    var $i_buy;
    var $i_cat;
    public  function  __construct($i_cat,$b_name, $i_model, $i_price, $i_pic, $i_desc, $i_sex, $i_qty, $i_buy) {
        $this->i_cat = $i_cat;
        $this->b_name = $b_name;
        $this->i_model = $i_model;
        $this->i_price = $i_price;
        $this->i_pic = $i_pic;
        $this->i_desc = $i_desc;
        $this->i_sex = $i_sex;
        $this->i_qty = $i_qty;
        $this->i_buy = $i_buy;
    }
    public function getItem(){
        return array('i_cat'=>$this->i_cat,'b_name'=>$this->b_name,'i_model'=>$this->i_model,'i_price'=>$this->i_price,
                     'i_pic'=>$this->i_pic,'i_desc'=>$this->i_desc,'i_sex'=>$this->i_sex,'i_qty'=>$this->i_qty, 'i_buy'=>$this->i_buy);
    }
    public function calcItemBuys($b_name, $i_model){
        $i_buys = $this->itemBuys($b_name, $i_model);
        $i = 0;
        foreach ($i_buys as $i_buy){
            $i = $i + $i_buy['C_QTY'];
        }
        return $i;
    }
    public function allItems(){
        $db_man = new DBMan();
        $query = "select *
                  from item
                  where I_SELL = 'yes'";
        $result = $db_man->send_query($query);
        $item = array();
        if(mysql_affected_rows() > 0){
            $i = 0;
            while($x = mysql_fetch_array($result)){
                if(!in_array($item, $item)){
                    $item[$i] = $x;
                    $i++;
                }
            }
        }
        return $item;
    }
    private function itemBuys($b_name, $i_model){
        $db_man = new DBMan();
        $query = "select *
                  from cart, purchase
                  where cart.P_NUM = purchase.P_NUM and B_NAME = '$b_name' and I_MODEL = '$i_model' and P_STATUS = 'completed'";
        $result = $db_man->send_query($query);
        $buy = array();
        if(mysql_affected_rows() > 0){
            $i = 0;
            while($item = mysql_fetch_array($result)){
                if(!in_array($item, $buy)){
                    $buy[$i] = $item;
                    $i++;
                }
            }
        }
        return $buy;
    }
}
?>
