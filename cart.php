<?php
require('header.php');

?>
<style>.btn {
    display: inline-block;
    height: 39px;
    /* line-height: 45px; */
    text-align: center;
    text-transform: uppercase;
    background: #212121;
    color: #ffffff;
    font-family: "Poppins";
    padding: 0 6px;
    font-weight: 600;
    letter-spacing: 1px;
    font-size: 12px;
    transition: all 0.3s ease-in-out 0s;
}
.btn:hover{
    background: #c43b68;
    color: #ffffff;
}</style>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">shopping cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               

                            <div class="table-content table-responsive">
                            <?php  if (isset($_SESSION['cart'])) {
                                           ?>
                                            <table>
                                            <thead>
                                                <tr>
                                                    <th class="product-thumbnail">products</th>
                                                    <th class="product-name">name of products</th>
                                                    <th class="product-price">Price</th>
                                                    <th class="product-quantity">Quantity</th>
                                                    <th class="product-subtotal">Total</th>
                                                    <th class="product-remove">Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
                                           
                                        //    print_r( $_SESSION['cart']);
                                           foreach ($_SESSION['cart'] as $key => $value) {
// echo $key;
                                            $product_detail=getProduct($conn,"","",$key);
                                            // print_r($product_detail);
                                            $id=$product_detail[0]['id'];
                                            $name=$product_detail[0]['name'];
                                            $mrp=$product_detail[0]['mrp'];
                                            $price=0;
                                            $price=$product_detail[0]['price'];
                                            $qty=0;
                                            $qty=$value['qty'];

                                            $total=(int)$price*(int)$qty;
?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="media/product/<?php echo $product_detail[0]['image'] ?>" alt="product img" /></a></td>
                                            <td class="product-name"><a href="product-details.php?id=<?= $id ?>"><?= $name ?></a>
                                                <ul  class="pro__prize">
                                                    <li class="old__prize" STYLE="text-decoration:line-through">&#8377 <?= $mrp ?></li>
                                                    <li>&#8377 <?= $price ?></li>
                                    <li style="margin-left:5px; color:red;padding:2px;">  <?php echo round(($product_detail[0]['mrp']-$product_detail[0]['price'])/$product_detail[0]['mrp']*100)  ?>&percnt; off</li>

                                                </ul>
                                            </td>
                                            <td class="product-price"><span class="amount">&#8377 <?= $price ?></span></td>
                                            <td class="product-quantity"><input type="number" id="<?php echo $id?>qty" value="<?= $qty?>" /> <button type="submit" class="btn" onclick="manageCart('<?=$id?>','update')">Update</button> </td>
                                            <td class="product-subtotal">&#8377 <?= $total ?></td>
                                            <td class="product-remove"><a href="javascript:void(0);" onclick="manageCart(<?php echo $id?>,'delete')"><i class="icon-trash icons"></i></a></td>
                                        </tr>

                                        <?php }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="#">Continue Shopping</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="#">update</a>
                                            <a href="checkout.php">checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                    <?php }else{
                        echo "<center><h2 style='margin-bottom: 40px;'>Cart is Empty<h2><center>";
                        echo "<div class='buttons-cart' style='margin-bottom: 40px;'>
                        <a href='index.php'>Continue Shopping</a>
                    </div>";
                                
                                
                    }?>
                </div>
            </div>
        </div>
        </div>
        
        <!-- cart-main-area end -->
        <!-- End Banner Area -->
    <?php 
    require('footer.php');
    ?>