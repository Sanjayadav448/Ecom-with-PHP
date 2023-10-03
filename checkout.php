<?php
require('header.php');

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    ?>
    <script>
        window.location.href = "index.php";
    </script>
    <?php
}


$totalprice = 0;
foreach ($_SESSION['cart'] as $key => $value) {

    $product_detail = getProduct($conn, "", "", $key);
    $price = $product_detail[0]['price'];
    $qty = $value['qty'];
    $totalprice = $totalprice + ((int)$price * (int)$qty);
}

if (isset($_POST['submit'])) {
    $address=mysqli_real_escape_string($conn,$_POST['Street_address']);
    $postcode=mysqli_real_escape_string($conn,$_POST['postcode']);
    $city=mysqli_real_escape_string($conn,$_POST['City']);
    $payment=mysqli_real_escape_string($conn,$_POST['payment']);
    $user_id=$_SESSION['id'];
    $totalrupee = $totalprice * 10 / 100;
    $totalammount=$totalprice+$totalrupee;
    if ($payment=="cod") {
        $payment_status="success";
        # code...
    }else{$payment_status="pending";}
    
    $order_status="pending";
    $addon=date('Y-m-d h:i:s');
    mysqli_query($conn,"INSERT INTO `order`(`user_id`, `address`, `city`,`pincode`,`payment_type`,`total_price`,`payment_status`,`order_status`,`addon`) 
    VALUES ('$user_id','$address','$city','$postcode','$payment','$totalammount','$payment_status','$order_status','$addon')");
    # code...


# inserting Order details....start---->

    $order_id=mysqli_insert_id($conn);
    foreach ($_SESSION['cart'] as $key => $value) {

        $product_detail = getProduct($conn, "", "", $key);
        $price = $product_detail[0]['price'];
        $qty = $value['qty'];
    

        mysqli_query($conn,"INSERT INTO `order_details`(`order_id`, `product_id`, `qty`,`price`,`addon`) 
                      VALUES ('$order_id','$key','$qty','$price','$addon')");
    
    }
# inserting Order details....End---->
    
unset($_SESSION['cart']);
header('Refresh:5; location:order.php');
// header("location:../index.php?page=checkout&order_id=".$order_id."&payment_status=".urlencode(base64_encode($payment))."&totalamount=".urlencode(base64_encode((floatval($totalammount)))));



}

?>

<style>
    .accordion .accordion__hide {
        background: #f4f4f4;
        height: 65px;
        line-height: 65px;
        display: flex;
        align-items: center;
        padding: 0 30px;
        position: relative;
        font-size: 16px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 10px;
        font-family: "Poppins";
        cursor: pointer;
    }

    .btn {
        display: inline-block;
        height: 45px;
        line-height: 45px;
        text-align: center;
        text-transform: uppercase;
        background: #212121;
        color: #ffffff;
        font-family: "Poppins";
        padding: 0 45px;
        font-weight: 600;
        letter-spacing: 1px;
        font-size: 16px;
        transition: all 0.3s ease-in-out 0s;
    }

    .btn:hover {
        background: #c43b68;
        color: #ffffff;
    }
</style><!-- Start Bradcaump area -->
<div class="ht__bradcaump__area"
    style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">

                            <?php
                            $accordian = 'accordion__title';
                            if (!isset($_SESSION['User_login'])) {
                                $accordian = 'accordion__hide';
                                ?>

                                <div class="accordion__title">
                                    Checkout Method
                                </div>
                                <div class="accordion__body">
                                    <div class="accordion__body__form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form method="post">
                                                        <h5 class="checkout-method__title">Login</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" name="email" class="email" id="email_error"
                                                                placeholder="Your Email*" style="width:100%">
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" name="password" class="password"
                                                                id="password_error" placeholder="Your Password*"
                                                                style="width:100%">

                                                        </div>
                                                        <p class="require">* Required fields</p>
                                                        <div class="dark-btn">
                                                            <button type="button" href='javascript:void(0);'
                                                                onclick="loginUser()" name="login"
                                                                class="btn">Login</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form method="post">
                                                        <h5 class="checkout-method__title">Register</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Name</label>
                                                            <input type="text" name="name" id="name"
                                                                placeholder="Your Name*" style="width:100%">
                                                            <span class="field_errror" id="name_error"> </span>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" name="email" id="email"
                                                                placeholder="Your Email*" style="width:100%">
                                                            <span class="field_errror email_err" id="email_error"></span>

                                                        </div>

                                                        <div class="single-input">
                                                            <label for="user-email">Mobile No.</label>
                                                            <input type="tel" name="name" id="mobile"
                                                                placeholder="Your Mobile*" style="width:100%">
                                                            <span class="field_errror" id="mobile_error"> </span>

                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" name="name" id="password"
                                                                placeholder="Your Password*" style="width:100%">
                                                            <span class="field_errror pass_err" id="password_error"> </span>

                                                        </div>
                                                        <div class="dark-btn">
                                                            <button type="button" class="btn" id="btn"
                                                                onclick="userRegistration()">Register</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <div class="<?php echo $accordian ?>">
                                Address Information
                            </div>
                            <form  method="post">
                            <div class="accordion__body">
                                <div class="bilinfo">
                                    
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" name="Street_address"
                                                        placeholder="Street Address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="City" placeholder="City/State" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="postcode" placeholder="Post code/ zip"
                                                        required>
                                                </div>
                                            </div>

                                        </div>
                                    
                                </div>
                            </div>


                            <div class="<?php echo $accordian ?>">
                                payment information
                            </div>
                            <div class="accordion__body">
                                <div class="paymentinfo">
                                    <div class="single-method">
                                        <input type="radio" name="payment" value="cod" id="cod" required > <label
                                            Style="margin-top: 15px;
                                            font-family: Poppins;
                                            font-size: 16px;" for="cod"> Cash On Delivery</label>
                                    </div>
                                    <div class="single-method">
                                    <input type="radio" name="payment" value="Online" id="online" required > <label
                                            Style="margin-top: 15px;
                                            font-family: Poppins;
                                            font-size: 16px;" for="online"> Pay Online</label>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="dark-btn">
                                <button type="submit" class="btn" name="submit" id="btn" >Order</button>

                            </div>
                        </form>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">

                        <?php
                        $totalprice = 0;
                        foreach ($_SESSION['cart'] as $key => $value) {

                            $product_detail = getProduct($conn, "", "", $key);
                            $id = $product_detail[0]['id'];
                            $name = $product_detail[0]['name'];
                            $mrp = $product_detail[0]['mrp'];
                            $price = $product_detail[0]['price'];
                            $qty = $value['qty'];
                            $totalprice = $totalprice + $price * $qty;
                            $total = $price * $qty;
                            ?>
                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="media/product/<?php echo $product_detail[0]['image'] ?>" alt="ordered item">
                                </div>
                                <div class="single-item__content">
                                    <a href="#">
                                        <?= $name ?>
                                    </a>
                                    <span class="price">&#8377
                                        <?= $price ?>
                                    </span>
                                </div>
                                <div class="single-item__remove">
                                    <a href="javascript:void(0);" onclick="manageCart(<?= $id ?>,'delete')"><i
                                            class="zmdi zmdi-delete"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="order-details__count">
                            <div class="order-details__count__single">
                                <h5>sub total</h5>
                                <span class="price">&#8377
                                    <?= $totalprice ?>
                                </span>
                            </div>
                            <div class="order-details__count__single">
                                <h5>Tax</h5>
                                <span class="price">&#8377
                                    <?php $totalrupee = round($totalprice * 10 / 100);
                                    echo $totalrupee ?>
                                </span>
                            </div>
                        </div>
                        <div class="ordre-details__total">
                            <h5>Order total</h5>
                            <span class="price">&#8377
                                <?= $totalprice + $totalrupee; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/custom.js"></script>

    <!-- cart-main-area end -->
    <!-- Start Footer Area -->
    <footer id="htc__footer">
        <!-- Start Footer Widget -->
        <div class="footer__container bg__cat--1">
            <div class="container">
                <div class="row">
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="footer">
                            <h2 class="title__line--2">ABOUT US</h2>
                            <div class="ft__details">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim</p>
                                <div class="ft__social__link">
                                    <ul class="social__link">
                                        <li><a href="#"><i class="icon-social-twitter icons"></i></a></li>

                                        <li><a href="#"><i class="icon-social-instagram icons"></i></a></li>

                                        <li><a href="#"><i class="icon-social-facebook icons"></i></a></li>

                                        <li><a href="#"><i class="icon-social-google icons"></i></a></li>

                                        <li><a href="#"><i class="icon-social-linkedin icons"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-2 col-sm-6 col-xs-12 xmt-40">
                        <div class="footer">
                            <h2 class="title__line--2">information</h2>
                            <div class="ft__inner">
                                <ul class="ft__list">
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">Privacy & Policy</a></li>
                                    <li><a href="#">Terms & Condition</a></li>
                                    <li><a href="#">Manufactures</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-2 col-sm-6 col-xs-12 xmt-40 smt-40">
                        <div class="footer">
                            <h2 class="title__line--2">my account</h2>
                            <div class="ft__inner">
                                <ul class="ft__list">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="cart.html">My Cart</a></li>
                                    <li><a href="#">Login</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-2 col-sm-6 col-xs-12 xmt-40 smt-40">
                        <div class="footer">
                            <h2 class="title__line--2">Our service</h2>
                            <div class="ft__inner">
                                <ul class="ft__list">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="cart.html">My Cart</a></li>
                                    <li><a href="#">Login</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-3 col-sm-6 col-xs-12 xmt-40 smt-40">
                        <div class="footer">
                            <h2 class="title__line--2">NEWSLETTER </h2>
                            <div class="ft__inner">
                                <div class="news__input">
                                    <input type="text" placeholder="Your Mail*">
                                    <div class="send__btn">
                                        <a class="fr__btn" href="#">Send Mail</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                </div>
            </div>
        </div>
        <!-- End Footer Widget -->
        <!-- Start Copyright Area -->
        <div class="htc__copyright bg__cat--5">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="copyright__inner">
                            <p>Copyright© <a href="https://freethemescloud.com/">Free themes Cloud</a> 2018. All right
                                reserved.</p>
                            <a href="#"><img src="images/others/shape/paypol.png" alt="payment images"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->
    </footer>
    <!-- End Footer Style -->
</div>
<!-- Body main wrapper end -->

<!-- Placed js at the end of the document so the pages load faster -->

<!-- jquery latest version -->
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap framework js -->
<script src="js/bootstrap.min.js"></script>
<!-- All js plugins included in this file. -->
<script src="js/plugins.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<!-- Waypoints.min.js. -->
<script src="js/waypoints.min.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="js/main.js"></script>

</body>

</html>