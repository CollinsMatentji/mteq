<?php
if(isset ($_GET['op'])){
    if($_GET['op']=='forgot_pass'){
        include 'sign_up/request_pass.php';
    }
}
else{
    include 'sign_up/login_register.php';
}
?>