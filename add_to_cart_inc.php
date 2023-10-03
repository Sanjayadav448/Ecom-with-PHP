<?php
class manage_cart{

function addProduct($pid,$qty,){
    $_SESSION['cart'][$pid]['qty']=$qty;

}
function updateProduct($pid,$qty){
    if (isset($_SESSION['cart'][$pid])) {
            $_SESSION['cart'][$pid]['qty'] = $qty ;  //update the qty of product in cart session array.
}
}

function removeProduct($pid){
    if (isset($_SESSION['cart'][$pid])) {
        unset($_SESSION['cart'][$pid]);
        # code...
    }
}
function EmptyCart(){
    unset ($_SESSION["cart"]);
}

function totalProduct(){
    if(isset($_SESSION['cart'])){
    return count($_SESSION['cart']);

}else{
    return 0;
}


}

}

?>