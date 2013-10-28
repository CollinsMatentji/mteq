<?php
// put your code here
$title = "account";
include 'oop/man/Page.php';
include 'oop/user/User.php';
include 'oop/man/SessionMan.php';
include 'oop/man/DBMan.php';
$user = new User();
$user->isUserLoged();
if(isset ($_POST['u_fname'])){
   $user->updateAccount('u_fname', $_POST['u_fname'],$_POST['u_pass']);
}
else if(isset ($_POST['u_lname'])){
   $user->updateAccount('u_lname', $_POST['u_lname'],$_POST['u_pass']);
}
else if(isset ($_POST['u_lname'])){
   $user->updateAccount('u_lname', $_POST['u_lname'],$_POST['u_pass']);
}
else if(isset ($_POST['u_tel'])){
   $user->updateAccount('u_tel', $_POST['u_tel'],$_POST['u_pass']);
}
else if(isset ($_POST['a_line1'])){
   $user->updateAccount('a_line1', $_POST['a_line1'],$_POST['u_pass']);
}
else if(isset ($_POST['a_line2'])){
   $user->updateAccount('a_line2', $_POST['a_line2'],$_POST['u_pass']);
}
else if(isset ($_POST['ap_code'])){
   $user->updateAccount('ap_code', $_POST['ap_code'],$_POST['u_pass']);
}
else if(isset ($_POST['ou_pass'])){
   $user->updateAccount('u_pass', $_POST['u_pass'],$_POST['ou_pass']);
}
if(isset ($_GET['changed'])){
    if($_GET['changed'] == "no"){
        ?>
        <script type="" language="javascript">
            alert("Invalid passwod, changes not saved!");
        </script>
       <?php
    }
    else{
        ?>
        <script type="" language="javascript">
            alert("Changes made successfuly!");
        </script>
       <?php
    }
}
$page = new Page();
$page->header($title);
$page->content($title);
$page->footer();
?>
