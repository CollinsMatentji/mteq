<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$buyer = new Buyer();
?>
<table width="100%" border="0">
    <tr>
        <td colspan="4" align="left">
             <b id="cat_head">
                MyCart
            </b>
        </td>
        <td align="right">
            <a href="purchase.php?" title="View or cancel purchases">MyPurchase</a>
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
        </td>
        <td>
        </td>
        <td align="right">
            <b>
                <?php
                echo $_COOKIE['b_item']." items";
                ?>
            </b>
        </td>
        <td align="right">
            <b>
                <?php
                echo "R".$_COOKIE['b_amnt'];
                ?>
            </b>
        </td>
    </tr>
    <tr>
        <td colspan="5" align="right">
            <hr />
        </td>
    </tr>
        <?php
        $cart = $buyer->getCart($_COOKIE['u_mail'],'pending');
        foreach ($cart as $c) {
            $on_shelf = "on_shelf";
            $shelf = "on shelf";
            if($c['I_QTY']== 0){
                $on_shelf = "off_shelf";
            }
            if($c['I_SELL'] == 'no'){
                $shelf = "off shelf";
                $on_shelf = "off_shelf";
            }
            echo "<tr><td width='5%'>";
            echo "<a href='catalouge.php?&name=".$c['B_NAME']."&model=".$c['I_MODEL']."&op=view' title='View item details'><img src='img/item/".$c['I_PIC'].".png' height='70' width='50'></a></td><td valign='top' align='left' width='20%'><b>
                 <a href='catalouge.php?&name=".$c['B_NAME']."&model=".$c['I_MODEL']."&op=view' title='View item details'>";
            echo $c['B_NAME']." ".$c['I_MODEL']."</a></b><br /><b id='$on_shelf'>".$c['I_QTY']." items $shelf<b>
                 <br />@R".$c['I_PRICE']."</td><td valign='top'>
                 <a href='cart.php?&op=remove_cart_item&name=".$c['B_NAME']."&model=".$c['I_MODEL']."' title='Remove item from card'>RemoveItem</a><br />
                 <a href='cart.php?&op=plus_one_item&name=".$c['B_NAME']."&model=".$c['I_MODEL']."' title='Add one to item'>1+</a><br />
                 <a href='cart.php?&op=minus_one_item&name=".$c['B_NAME']."&model=".$c['I_MODEL']."' title='Minus one from item'>1-</a></td><td align='right' valign='top'>";
            echo "x".$c['C_QTY'];
            echo "</td><td align='right' valign='top'>R".($c['I_PRICE'] * $c['C_QTY'])."</td></tr>";
            echo '<tr>
                    <td colspan="5" align="right">
                        <hr />
                    </td>
                </tr>';
        }
        ?>
    <tr>
        <td colspan="5" align="right">
            <b>Delivery</b> R0.00<br />
            <b>Sub-total</b> R<?php echo $_COOKIE['b_amnt'] ?><br /><br />
            <a href="index.php?" title="Continue Shopping">GoShopping</a> <a href='cart.php?&op=check_out' title="Checkout/make a purchase">CheckOut</a>
        </td>
    </tr>
</table>
