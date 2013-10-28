<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$admin = new Admin();
$buyer = new Buyer();
?>
<form id="man_purchase_form" name="man_purchase_form" action="admin.php?&op=purchases" method="post">
    <table width="100%">
        <tr>
            <td colspan="1" width="10%">
                <b id="cat_head">
                   Purchases
                </b>
            </td>
            <td align="left" colspan="3">
                &nbsp;&nbsp;
                <select name="p_status" onchange="sendManPurchaseForm()">
                    <?php
                    $p_month = "";
                    if(!isset ($_POST['p_status'])){
                        $p_status = "Started";
                    }
                    else{
                        $p_status = $_POST['p_status'];
                    }
                    setSelect($p_status);
                    ?>
                </select>
                <?php
                if($p_status != "Started" && $p_status != "Pending"){
                ?>
                <select name="p_month" onchange="sendManPurchaseForm()">
                    <?php
                    if(isset ($_POST['p_month'])){
                         $p_month = $_POST['p_month'];
                    }
                    else{
                        $p_month = date('F');
                    }
                    setSelectMonth($p_month);
                    ?>
                </select>
                <?php
                //echo date('Y-m',strtotime($p_month));
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="5" align="right">
                <hr />
            </td>
        </tr>
            <?php
            $purchase = $admin->getPurchase($p_status,date('Y-m',strtotime($p_month)));
            $t_amt = 0;
            $t_qty = 0;
            $p_num = 0;
            $i = 0;
            foreach ($purchase as $p) {
                if($p['P_DATE'] != NULL){
                    $e_date = $buyer->calcPurcahseExp($p['P_DATE']);
                    $date = explode(':', $p['P_DATE']);
                }
                else{
                    $date = "0000-000-00";
                    $e_date = "0000-00-00";
                    $ref = '00-0000-00-00';
                }
                if($p_num != $p['P_NUM']){
                    if($t_qty != 0){
                        echo "<tr><td></td><td></td><td></td><td align='right'><b>$t_qty</b></td><td align='right'><b>R$t_amt</b></td></tr>";
                        if(strtolower($p_status) == "started"){
                            echo "<tr><td colspan='5' align='right'><a href='admin.php?&op=purchases&ref=complete_purchase&p=".$p_num."' title='Complete purchase REF:$ref'>Complete</a></td></tr>";
                        }
                        $t_qty = 0;
                        $t_amt = 0;
                    }
                    if($p_status != "Pending"){
                        $ref = $p['P_NUM'].$date[0].$date[1];
                    }
                    else{
                        $ref = "000000";
                    }
                    echo "<tr><td colspan='3' witdh='10%'><b>REF: ".$ref."</td><td align='right'><b>Buyer: ".$p['U_LNAME']." ".$p['U_FNAME']."</b></td><td align='right'><b>Purchase duration: ".$date[0].":".$date[1]." - $e_date</b></td></tr>";
                    $p_num = $p['P_NUM'];
                }
                echo "<tr><td width='5%'>";
                echo "</td><td valign='top' align='left' width='20%'><b>
                     <a href='catalouge.php?&name=".$p['B_NAME']."&model=".$p['I_MODEL']."&op=view' title='View item details'>";
                echo $p['B_NAME']." ".$p['I_MODEL']."</a></b> <b>@R".$p['I_PRICE']."</b></td><td valign='top'>
                     </td><td align='right' valign='top'>";
                echo "x".$p['C_QTY'];
                echo "</td><td align='right' valign='top'>R".($p['I_PRICE'] * $p['C_QTY'])."</td></tr>";
                $t_amt = $t_amt + ($p['I_PRICE'] * $p['C_QTY']);
                $t_qty = $t_qty + $p['C_QTY'];
                if(strtolower($p_status) == 'started'){
                    $buyer->expirePurchase($e_date, $p_num);
                }
                $i++;
            }
            if(count($purchase) > 0){
                echo "<tr><td></td><td></td><td></td><td align='right'><b>$t_qty</b></td><td align='right'><b>R$t_amt</b></td></tr>";
                if(strtolower($p_status) == "started"){
                    echo "<tr><td colspan='5' align='right'><a href='admin.php?&op=purchases&ref=complete_purchase&p=".$p['P_NUM']."' title='Complete purchase REF:$ref'>Complete</a></td></tr>";
                }
            }
            ?>
    </table>
</form>
<br />
<?php
function setSelectMonth($p_month){
    $month = array('January','February','March','April','May','June','July','August','September','October','November','December');
    foreach ($month as $m){
        echo "<option";
        if($m == $p_month){
            echo " selected=''";
        }
        echo ">$m</option>";
    }
}
function setSelect($p_status){
    if($p_status == "Started"){
        echo '<option selected="">Started</option>
              <option>Pending</option>
              <option>Completed</option>
              <option>Cancelled</option>
              <option>Expired</option>';
    }
    else if($p_status == "Pending"){
        echo '<option>Started</option>
              <option selected="">Pending</option>
              <option>Completed</option>
              <option>Cancelled</option>
              <option>Expired</option>';
    }
    else if($p_status == "Completed"){
        echo '<option>Started</option>
              <option>Pending</option>
              <option selected="">Completed</option>
              <option>Cancelled</option>
              <option>Expired</option>';
    }
    else if($p_status == "Cancelled"){
        echo '<option>Started</option>
              <option>Pending</option>
              <option>Completed</option>
              <option selected="">Cancelled</option>
              <option>Expired</option>';
    }
    else if($p_status == "Expired"){
          echo '<option>Started</option>
                <option>Pending</option>
                <option>Completed</option>
                <option>Cancelled</option>
                <option selected="">Expired</option>';
    }
}
?>
