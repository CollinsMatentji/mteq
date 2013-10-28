<?php
$page = new Page();
$user = new User();
if(isset ($_GET['sign_out'])){
    $user->logout();
}
if(isset ($_GET['account'])){
    header("location:account.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $page->title($title)?></title>
        <link href="style/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.hotkeys-0.7.9.min.js"></script>
        <script type="text/javascript" language="javascript">
        $(document).bind('keydown', 'shift+l', function() {
               window.location = "sign_up.php?";
        });
        $(document).bind('keydown', 'shift+c', function() {
               window.location = "cart.php?";
        });
        $(document).bind('keydown', 'shift+p', function() {
               window.location = "purchase.php?";
        });
        $(document).bind('keydown', 'shift+a', function() {
               window.location = "account.php?";
        });
        $(document).bind('keydown', 'shift+o', function() {
               window.location = "index.php?&sign_out";
        });
        </script>
        <script src="js/validate.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript">
        function setClock(){
            var time, hour, minute;
            time = new Date();
            hour = time.getHours();
            minute = time.getMinutes();
            if(hour < 10){
                hour = "0"+hour;
            }
            if(minute < 10){
             minute = "0"+minute;
            }
            document.getElementById('clock').innerHTML = hour+":"+minute+"&nbsp;";
        }
        function sendCardForm(){
            document.cat_form.submit();
        }
        function sendManPurchaseForm(){
            document.man_purchase_form.submit();
        }
        function previewImg(){
            document.getElementById('tmp_i_pic').innerHTML = document.getElementById("i_pic").value;
        }
        function newBrandField(){
            var b_name = $('#b_name').val();
            if(b_name == "New brand"){
                document.getElementById('n_bname').innerHTML = "<div style='font-weight:normal; margin: 5px 0px 0px 0px'><input type='text' size='28' value='New brand name' name='n_bname'></div>";
            }
            else{
                document.getElementById('n_bname').innerHTML = "";
            }
        }
        function changeImg(path,hidden,link){
            document.getElementById('l_img').innerHTML = '<img id="largeImg" src="'+path+'" alt="Large image" />';
            document.getElementById('i_det').innerHTML = document.getElementById(hidden).value;
            document.getElementById('add_link').href = document.getElementById(link).value;
        }
        </script>
    </head>
    <body onload="setClock()" onmouseover="setClock()">
        <?php
        if($title != "Sign In or Sign Up" && $title != "account" && $title != "About us" && $title != "Contact us" && $title != "Cart" && $title != "Admin" && $title != "Search"){
        ?>
        <table border="0" class="tbl_card">
            <td valign="bottom">
                MyCart<br style="margin: 0px"/>
                <?php
                if(!isset ($_COOKIE['u_mail'])){
                    echo "<a href='cart.php' title='View, plus or minus cart items'>0 items</a>";
                }
                else{
                    $buyer = new Buyer();
                    echo "<a href='cart.php?' title='View, plus or minus cart items'>".$_COOKIE['b_item']." items</a>";
                }
                ?>
            </td>
            <td class='t_card' align="center" valign="top">
                <p style="padding-bottom: 15px">
                    <?php
                    if(!isset ($_COOKIE['u_mail'])){
                        echo '<a  href="#" style="padding-left: 2px;">0</a>';
                    }
                    else{
                        $buyer = new Buyer();
                        echo '<a  href="cart.php?" style="padding-left: 2px;">'.$_COOKIE['b_item'].'</a>';
                    }
                    ?>
                </p>
            </td>
        </table>
        <?php
        }
        ?>
        <div class="head">
            <table width="940px" align="center" border="0" style="color: #CCCCCC; font-size: 13px">
                <tr>
                    <td valign="top" width="5%">
                        <a href="index.php"><img src="img/logo.png" alt="Ticking Style Logo" title="Ticking Style - Home" ></a>
                    </td>
                    <td align="left" valign="top">
                        Help Center: 0861 925 102<br />
                        <a href="index.php" title="Ticking Style - Home" >Home</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="about.php" title="About Ticking Style">About Us</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="contact.php" title="Contact Ticking Style">Contact Us</a>
                    </td>
                    <td align="left" valign="middle" style="padding-top: 11px;">
                        <form action="search.php?" name="" method="get">
                            <b id="search_div"><input type="text" size="55" style="color: gray" id="search" title="Enter a search term" name="search_term"></b><b style="height: 31px; vertical-align: middle;"><input type="submit" value="Search"></b>
                        </form>
                    </td>
                    <td align="left" valign="top" style='padding-top:18px'>
                        <?php
                        if(!isset ($_COOKIE['u_mail'])){
                        ?>
                        <a href="sign_up.php" title="Login to Ticking Style">Log In</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="sign_up.php" title="Register with Ticking Style">Register</a>
                        <?php
                        }
                        else{
                            echo "<td align='left' valign='top'></td><td align='right' valign=''></td><td align='right' valign='' style='padding-top:18px'>";
                            echo '<a href="?p='.$_SERVER['PHP_SELF'].'&account" title="View/Change your account details">'.$_COOKIE['u_lname']." ".$_COOKIE['u_fname'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="?p='.$_SERVER['PHP_SELF'].'&sign_out" title="Logout from Ticking Style">Log Out</a>';
                        }
                        ?>
                    </td>

                </tr>
            </table>
        </div>
        <table width="940px" align="center" border="0">
            <tr>
                <td>
                    <b id="clock">
                    </b>
                    <?php
                        echo date('d l, F Y');
                    ?>
                </td>
                <td align="right">
                    <?php
                    if(isset ($_COOKIE['u_mail'])){
                        if($_COOKIE['u_role'] == "admin"){
                            echo '<a href="admin.php?&op=users" title="Manage users"> [Users] </a><a href="admin.php?&op=purchases" title="Manage purchases"> [Purchases] </a> <a href="admin.php?&op=new_watch" title="Add new watch"> [New Gadget] </a>';
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="left" class="sub_head" valign="top" colspan="2">
                    <div style="margin: 5px 0px 0px 0px">
                        &nbsp;<b>Categories:</b> <?php $page->catLink(); ?>
                    </div>
                </td>
            </tr>
        </table>
        <table width="940px" align="center" style="margin-top: 0px" border="0" >
            <tr>
                <td>
                   
