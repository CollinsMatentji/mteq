<?php
$item = new Item('','', '', '', '', '', '', '', '');
$all_item = $item->allItems();
shuffle($all_item);
?>
<table border="0">
    <tr>
        <td>
            <h3>Welcome to M-teQ!</h3>
        </td>
    </tr>
    <tr style="padding-top: 0px">
        <td>
            <?php
            $x=0;
            foreach ($all_item as $a_i){
                if($x < 1){
                    $path = 'img/item/'.$a_i['I_PIC'].'.png';
                    $b_name = $a_i['B_NAME'];
                    $i_model = $a_i['I_MODEL'];
                    $i_price = $a_i['I_PRICE'];
                    $i_sex = $a_i['I_SEX'];
                }
                $x++;
            }
            ?>
            <b id="l_img"><img id="largeImg" src="<?php echo $path ?>" alt="Large image" /></b><br />
        </td>
        <td valign="top" style="padding-left: 20px" align="left">
            <b id="sub_head">Make a purchase now online!</b><br />
            <b class="thumbs">
                <?php
                $i = 0;
                $x = 4;
                foreach ($all_item as $a_i){
                    if($i < 10){
                        $path = '"img/item/'.$a_i['I_PIC'].'.png"';
                        $b_name = $a_i['B_NAME'];
                        $i_model = $a_i['I_MODEL'];
                        $i_price = $a_i['I_PRICE'];
                        $i_sex = $a_i['I_SEX'];
                        $hidden = '"'.$b_name.$i_model.'"';
                        $link = '"'.$b_name.$i_model.'_link'.'"';
                        echo "<a href='#' onclick='changeImg($path,$hidden,$link)'><img id='sml_img' src='img/item/".$a_i['I_PIC'].".png' /></a>&nbsp;";
                        echo "<input type='hidden' id='$b_name$i_model' value='<b>$b_name</b> $i_model for $i_sex <b>@R$i_price</b>'>";
                        echo "<input type='hidden' id='$b_name$i_model"."_link' value='catalouge.php?&cat=$b_name&model=$i_model&op=add_to_cart'>";
                        if($i == $x){
                            echo "<br />";
                            $x = $x + 5;
                        }
                    }
                    $i++;
                }
                ?>
            </b>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <b id="i_det"><b><?php echo $b_name ?></b> <?php echo $i_model ?> for <?php echo $i_sex ?> <b>@R<?php echo $i_price ?></b></b>
            <?php
            if(!isset ($_COOKIE['u_mail'])){
                echo '<a href="sign_up.php?">Buy</a>';
            }
            else{
                echo "<a id='add_link' href='catalouge.php?&cat=$b_name&model=$i_model&op=add_to_cart'>Add to cart</a>";
            }
            ?>
        </td>
    </tr>
    <!--tr>
        <td colspan="2" style="padding-top: 20px">
            <b id="sub_head">Featured Brands</b><br />
            <b class="b_thumbs">
                <img src="img/service/dflt.png" />&nbsp;
                <img src="img/service/dflt.png" />&nbsp;
                <img src="img/service/dflt.png" />&nbsp;
                <img src="img/service/dflt.png" />&nbsp;
                <img src="img/service/dflt.png" />&nbsp;
                <img src="img/service/dflt.png" />&nbsp;
                <img src="img/service/dflt.png" />&nbsp;
                <img src="img/service/dflt.png" />&nbsp;
                <img src="img/service/dflt.png" />&nbsp;
                <img src="img/service/dflt.png" />&nbsp;
                <a href='#' onmouseover='changeImg("img/item/Rolex_sss6.png")'><img src="img/service/dflt.png"/></a>&nbsp;
            </b>
        </td>
    </tr-->
</table>
<a href="#" onmousemove=""></a>