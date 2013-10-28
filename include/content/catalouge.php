<?php
$user = new User();
if(isset ($_GET['cat'])){
$i_sex = "All Genders";
if(isset ($_POST['i_sex'])){
    $i_sex = $_POST['i_sex'];
}
?>
<form action="catalouge.php?&cat=<?php echo $_GET['cat']?>" method="post" id="cat_form" name="cat_form" >
    <table>
        <tr>
            <td>
                <b id="cat_head">
                    <?php
                    echo $_REQUEST['cat']." for:";
                    ?>
                </b>
            </td>
            <td>
                &nbsp;&nbsp;
                <select name="i_sex" onchange="sendCardForm()">
                    <?php
                    setSelect($i_sex);
                    ?>
                </select>
            </td>
        </tr>
    </table>
</form>
<?php
$user->viewCat($_REQUEST['cat'],$i_sex);
}
else {
    echo '<b id="cat_head">'.$_GET['name']." ".$_GET['model'].'</b><br />';
    $user->viewItem($_GET['name'], $_GET['model']);
}
function setSelect($i_sex){
    if($i_sex == "All Genders"){
        echo '<option selected="">All Genders</option>
              <option>Men and Ladies</option>
              <option>Men</option>
              <option>Ladies</option>';
    }
    else if($i_sex == "Men and Ladies"){
        echo '<option >All Genders</option>
              <option selected="">Men and Ladies</option>
              <option>Men</option>
              <option>Ladies</option>';
    }
    else if($i_sex == "Men"){
        echo '<option selected="">All Genders</option>
              <option>Men and Ladies</option>
              <option selected="">Men</option>
              <option>Ladies</option>';
    }
    else if($i_sex == "Ladies"){
        echo '<option selected="">All Genders</option>
              <option>Men and Ladies</option>
              <option>Men</option>
              <option selected="">Ladies</option>';
    }
}
?>
