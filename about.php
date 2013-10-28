<?php
// put your code here
$title = "About us";
include 'oop/man/Page.php';
include 'oop/user/User.php';
include 'oop/man/SessionMan.php';
include 'oop/man/DBMan.php';
$page = new Page();
$page->header($title);
$page->content($title);
$page->footer();
?>
