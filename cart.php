<?php
// put your code here
$title = "Cart";
include 'oop/man/DBMan.php';
include 'oop/man/Page.php';
include 'oop/user/User.php';
include 'oop/user/Buyer.php';
include 'oop/man/SessionMan.php';
$user = new User();
$buyer = new Buyer();
$user->isUserLoged();
if(isset ($_GET['op'])){
    if($_GET['op'] == "remove_cart_item"){
        $buyer->removeCardItem($_COOKIE['u_mail'], $_GET['name'], $_GET['model']);
    }
    if($_GET['op'] == 'plus_one_item'){
        $buyer->addCardItem($_COOKIE['u_mail'], $_GET['name'], $_GET['model']);
    }
    if($_GET['op'] == 'minus_one_item'){
        $buyer->minusCardItem($_COOKIE['u_mail'], $_GET['name'], $_GET['model']);
    }
    if($_GET['op'] == 'check_out'){
        $buyer->checkOut($_COOKIE['u_mail'],$_COOKIE['u_subsc']);
    }
}
$page = new Page();
$page->header($title);
$page->content($title);
$page->footer();
?>
