<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$buyer = new Buyer();
?>
<table width="100%" border="0">
    <tr>
        <td colspan="5" align="left">
             <b id="cat_head">
                MyPurchase
            </b>
        </td>
    </tr>
    <tr>
        <td colspan="5" align="right">
            <hr />
        </td>
    </tr>
        <?php
        $cart = $buyer->getCart($_COOKIE['u_mail'],'started');
        $t_amt = 0;
        $t_qty = 0;
        $p_num = 0;
        $i = 0;
        foreach ($cart as $c) {
            $e_date = $buyer->calcPurcahseExp($c['P_DATE']);
            $date = explode(':', $c['P_DATE']);
            if(isset ($_GET['op'])){
                if($_GET['op'] == 'clear_purchase'){
                    $buyer->cancelPurchase($c['P_NUM']);
                }
            }
            if($p_num != $c['P_NUM']){
                if($t_qty != 0){
                    echo "<tr><td></td><td></td><td></td><td align='right'><b>$t_qty</b></td><td align='right'><b>R$t_amt</b></td></tr>";
                    echo "<tr><td colspan='5' align='right'><a href='purchase.php?&op=cancel_purchase&p=".$p_num."' title='Cancel purchae REF:$ref'>Cancel</a></td></tr>";
                    $t_qty = 0;
                    $t_amt = 0;
                }
                $ref = $c['P_NUM'].$date[0].$date[1];
                echo "<tr><td colspan='4' witdh='10%'><b>REF: ".$ref."</td><td align='right'><b>Purchase duration: ".$date[0].":".$date[1]." - $e_date</b></td></tr>";
                $p_num = $c['P_NUM'];
            }
            echo "<tr><td width='5%'>";
            echo "</td><td valign='top' align='left' width='20%'><b>
                 <a href='catalouge.php?&name=".$c['B_NAME']."&model=".$c['I_MODEL']."&op=view' title='View item details'>";
            echo $c['B_NAME']." ".$c['I_MODEL']."</a></b> <b>@R".$c['I_PRICE']."</b></td><td valign='top'>
                 </td><td align='right' valign='top'>";
            echo "x".$c['C_QTY'];
            echo "</td><td align='right' valign='top'>R".($c['I_PRICE'] * $c['C_QTY'])."</td></tr>";
            $t_amt = $t_amt + ($c['I_PRICE'] * $c['C_QTY']);
            $t_qty = $t_qty + $c['C_QTY'];
            $i++;
            $buyer->expirePurchase($e_date,$p_num);
        }
        if(count($cart) > 0){
            echo "<tr><td></td><td></td><td></td><td align='right'><b>$t_qty</b></td><td align='right'><b>R$t_amt</b></td></tr>";
            echo "<tr><td colspan='5' align='right'><a href='purchase.php?&op=cancel_purchase&p=".$c['P_NUM']."' title='Cancel purchae REF:$ref'>Cancel</a></td></tr>";
        }
        ?>
        <tr>
            <td colspan="5">
                <hr />
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <b>Payment options</b><br />
            </td>
        </tr>
        <tr>
            <td valign="top" align="left" >
                <b>1. Online payment</b><br />
                Account number:<br />
                <input type="text" size="24"><br />
                Account password:<br />
                <input type="password" size="24"><br />
                Ref:<br />
                <input type="text" size="24">
                <br /><input type="submit" value="Purchase" name="purchase">
            </td>
            <td colspan="2" valign="top" style="padding-left: 20px">
                &nbsp;<b>2.Bank deposit</b><br />&nbsp;&nbsp;&nbsp;&nbsp;<b>Acc holder:</b> Ticking Style<br />&nbsp;&nbsp;&nbsp;&nbsp;<b>Bank:</b> Absa
                <br />&nbsp;&nbsp;&nbsp;&nbsp;<b>Acc no:</b> 62 257 892 135<br />&nbsp;&nbsp;&nbsp;&nbsp;<b>Acc type:</b> Cheque
            </td>
            <td  align="left" valign="top" style="padding-left: 10px">
                <b id="ntc"><li>When you deposit, use your purchase REF as reference for each purchase.</li></b>
                <b id="ntc"><li>Purchase will be completed after recieving your paymanent.</li></b><br />
                <b id="ntc"><li>Note that, failure to complete your purchase will result in your account being decativated in future!</li></b>
            </td>
        </tr>
</table>
<br />
