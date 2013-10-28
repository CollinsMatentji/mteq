<?php
$db_man = new DBMan();
$search = $_GET['search_term'];
$query = "select * from item where B_NAME like '%$search%' or I_MODEL like '%$search%' or I_SEX like '%$search%'";
$search_term_arr = explode(' ', $search);
if(count($search_term_arr) > 0){
    if(count($search_term_arr) != 2){
        foreach ($search_term_arr as $search_term){
            $query.= " or B_NAME like '%$search_term%' or I_MODEL like '%$search_term%' or I_SEX like '%$search_term%' ";
        }
    }
    else
    {
         $query = "select * from item where B_NAME like '%$search_term_arr[0]%' and I_MODEL like '%$search_term_arr[1]%'";
    }
}
$result = $db_man->send_query($query);
$rows = mysql_affected_rows();
?>
<b id="cat_head">
    Search
</b>
<?php
if($_GET['search_term'] != 'Search for item'){
    echo $rows." results for ".ucfirst($search);
}
else{
    echo "Please enter a search term!";
}
$i = 0;
$x = 5;
echo "<table border='0' width='935' style='margin: 10px 0px 0px 0px'><tr>";
while ($item = mysql_fetch_array($result)){
   if($i == $x){
       echo "</tr><tr>";
       $x = $x + 5;
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
echo "</tr></table>";
?>