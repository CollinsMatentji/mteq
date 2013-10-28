<?php
// put your code here
$title = "Admin";
include 'oop/man/DBMan.php';
include 'oop/man/Page.php';
include 'oop/man/SessionMan.php';
include 'oop/man/UploadFile.php';
include 'oop/user/User.php';
include 'oop/user/Buyer.php';
include 'oop/user/Admin.php';
include 'oop/Item.php';
//op=purchases&ref=complete_purchase&p=8
$admin = new Admin();
if(isset ($_GET['op'])){
    if($_GET['op'] == "purchases"){
        if(isset ($_GET['ref'])){
            if($_GET['ref'] == "complete_purchase"){
                $admin->completePurchase($_GET['p']);
            }
        }
    }
    else if($_GET['op'] == "users"){
        if(isset ($_GET['ref'])){
            if($_GET['ref'] == 'unsubscribe'){
                $admin->unsubscribeUser($_GET['mail']);
            }
            else if($_GET['ref'] == 'subscribe'){
                $admin->subscribeUser($_GET['mail']);
            }
        }
    }
}
if(isset ($_POST['add_watch'])){
    $i_cat = $_POST['i_cat'];
    $b_name = $_POST['b_name'];
    $i_model = $_POST['i_model'];
    $i_price = $_POST['i_price'];
    $i_pic = "";
    $i_desc = $_POST['i_desc'];
    $i_sex = $_POST['i_sex'];
    $i_qty = 0;
    $i_buy = 0;
    $admin = new Admin();
    if($b_name == "New brand"){
        $b_name = $_POST['n_bname'];
        $admin->addBrand($b_name);
    }
    if(isset ($_FILES['i_pic'])){
        $file = $_FILES['i_pic'];
        $upDir = "img/item";
        $fname = $b_name."_".$i_model;
        $i_pic = $fname;
        $up_file = new UploadFile();
        $up_file->uploadImageFile($file, $upDir, $fname);
    }
    $item = new Item($i_cat,$b_name, $i_model, $i_price, $i_pic, $i_desc, $i_sex, $i_qty, $i_buy);
    $admin->addItem($item->getItem());
}
$page = new Page();
$page->header($title);
$page->content($title);
$page->footer();
?>
