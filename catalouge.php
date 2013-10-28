<?php
// put your code here
$title = "Watches";
include 'oop/man/Page.php';
include 'oop/user/User.php';
include 'oop/man/SessionMan.php';
include 'oop/man/DBMan.php';
include 'oop/man/UploadFile.php';
include 'oop/user/Admin.php';
include 'oop/user/Buyer.php';
include 'oop/Item.php';
if(isset ($_POST['save_item'])){
    $b_name = $_GET['name'];
    $i_model = $_GET['model'];
    $i_price = $_POST['i_price'];
    $i_pic = $_POST['i_pic'];
    $i_desc = $_POST['i_desc'];
    $i_sex = $_POST['i_sex'];
    $i_qty = 0;
    $i_buy = 0;
    $admin = new Admin();
    if(isset ($_FILES['ni_pic'])){
       $file = $_FILES['ni_pic'];
       $upDir = "img/item";
       $i_pic = $b_name."_".$i_model;
       $up_file = new UploadFile();
       $up_file->uploadImageFile($file, $upDir, $i_pic);
    }
    $item = new Item($b_name, $i_model, $i_price, $i_pic, $i_desc, $i_sex, $i_qty, $i_buy);
    $admin->editItem($item->getItem());
}
if(isset ($_POST['cancel_edit'])){
    header("location:catalouge.php?&name=".$_GET['name']."&model=".$_GET['model']."&op=view");
}
if(isset ($_GET['op'])){
    if($_GET['op'] == 'remove_on_shelf'){
        $admin = new Admin();
        $admin->minusShelfItem($_GET['name'], $_GET['model']);
    }
    if($_GET['op']=="add_to_cart"){
        $buyer = new Buyer();
        $buyer->addCardItem($_COOKIE['u_mail'], $_GET['cat'], $_GET['model']);
    }
    if($_GET['op'] == 'place_on_shelf'){
        $admin = new Admin();
        $admin->addShelfItem($_GET['name'], $_GET['model']);
    }
}
if(isset ($_POST['insert_item'])){
    $admin = new Admin();
    $admin->insertItem($_GET['name'], $_GET['model'], $_GET['qty'], $_POST['i_num']);
}
$page = new Page();
$page->header($title);
$page->content($title);
$page->footer();
?>