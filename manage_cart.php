<?php


require('connection_in.php');
require('add_to_cart_inc.php');
$id = $_POST['pid'];
$qty=$_POST['qty'];
$type=$_POST['type'];



$obj = new manage_cart();
if ($type=='add') {
    $obj->addProduct($id,$qty);
}
if ($type=='update') {
    $obj->updateProduct($id,$qty);
    # code...
}if ($type=='delete') {
    $obj->removeProduct($id);
}

echo $obj->totalProduct();
?>