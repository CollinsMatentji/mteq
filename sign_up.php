<?php
// put your code here
$title = "Sign In or Sign Up";
include 'oop/man/Page.php';
include 'oop/man/DBMan.php';
include 'oop/user/User.php';
include 'oop/user/Buyer.php';
include 'oop/man/SessionMan.php';
include 'oop/exception/UserException.php';
$user = new User();
if(isset ($_POST['sign_in'])){
    $u_mail = $_POST['lu_mail'];
    $u_pass = $_POST['lu_pass'];
    $user->login($u_mail, $u_pass);
}
if(isset ($_POST['request_pass'])){
    $user_det = $user->requestPass($_POST['u_mail']);
    $to = $_POST['u_mail'];
    $from = 'Ticking Style Admin<admin@tickingstyle.site40.net>';
    $subject = 'Password';
    $message = "<b>Hi, ".$user_det['U_LNAME']." ".$user_det['U_FNAME']."</b><br /><p>The login details your requested are:";
    $message.= "<br />username: ".$_POST['u_mail']."<br />password: ".$user_det['U_PASS']."</p>";
    $message.="<p>Thank you for using Ticking Style.</p>";
    $headers = "To: <$to>" . "\r\n";
    $headers.= "From: $from". "\r\n";
    $headers.= "Reply-To: $from\r\n";
    $headers.= "Return-Path: $from\r\n";
    $headers.= "MIME-version: 1.0\n";
    $headers.= "Content-type: text/html; charset= iso-8859-1\n";
    mail($to,$subject,$message,$headers);
}
if(isset ($_POST['cancel_pass_request'])){
    header("location:sign_up.php");
}
$page = new Page();
$page->header($title);
$page->content($title);
$page->footer();
?>