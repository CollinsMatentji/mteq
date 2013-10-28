<?php
// put your code here
$title = "Contact us";
include 'oop/man/Page.php';
include 'oop/user/User.php';
include 'oop/man/SessionMan.php';
include 'oop/man/DBMan.php';
if(isset ($_POST['send'])){
    $to = 'mrtmello@gmail.com';
    $cc = 'mrtrmello@yahoo.com';
    $from = "<".$_POST['u_mail'].">";
    $subject = 'User Message';
    $message = $_POST['u_msg'];
    $headers = "To: <$to>,<$cc>" . "\r\n";
    $headers.= "From: $from". "\r\n";
    $headers.= "Reply-To: $from\r\n";
    $headers.= "Return-Path: $from\r\n";
    $headers.= "MIME-version: 1.0\n";
    $headers.= "Content-type: text/html; charset= iso-8859-1\n";
    mail($to,$subject,$message,$headers);
}
$page = new Page();
$page->header($title);
$page->content($title);
$page->footer();
?>