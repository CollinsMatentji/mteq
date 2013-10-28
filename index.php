<?php
// put your code here
$title = "Welcome";
include 'oop/man/DBMan.php';
include 'oop/man/Page.php';
include 'oop/user/User.php';
include 'oop/user/Buyer.php';
include 'oop/Item.php';
include 'oop/man/SessionMan.php';
$page = new Page();
$page->header($title);
$page->content($title);
$page->footer();
?>

