<?php
if(isset ($_GET['op'])){
    if($_GET['op'] == 'new_watch'){
        include 'admin/new_watch.php';
    }
    if($_GET['op'] == 'purchases'){
        include 'admin/man_purchase.php';
    }
    if($_GET['op'] == 'users'){
        include 'admin/man_users.php';
    }
}
?>