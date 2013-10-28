<?php
// put your code here
$title = "Purchase";
include 'oop/man/DBMan.php';
include 'oop/man/Page.php';
include 'oop/user/User.php';
include 'oop/user/Buyer.php';
include 'oop/man/SessionMan.php';
$user = new User();
$buyer = new Buyer();
$user->isUserLoged();
if(isset ($_GET['op'])){
    if($_GET['op'] == 'cancel_purchase'){
        $buyer->cancelPurchase($_GET['p']);
    }
}
$page = new Page();
$page->header($title);
$page->content($title);
$page->footer();
?>