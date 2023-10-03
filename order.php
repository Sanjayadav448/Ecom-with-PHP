<?php
require('header.php');


if (!isset($_SESSION['User_login'])) {

    echo "<script>window.location.href='index.php';</script>";

}
?>

<style>

.wishlist-table table th, .wishlist-table table td {
    border-bottom: 1px solid #c1c1c1;
    border-right: none !important;
   
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    font-weight: 600;
    padding: 15px 10px;
    text-align: center;

}
.wishlist-table table th{
    color: #fff !important;
}
</style>
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
                                  <span class="breadcrumb-item active">Your Order</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- wishlist-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    
                                <?php
                                        $id=$_SESSION['id'];

                                        $result=mysqli_query($conn,"Select * from `order` where user_id='$id'");
                                        if (mysqli_num_rows($result)>0) {
                                            
                                            # code...
                                        ?>
                                    <table style="border:0px">
                                        <thead style="background-color: #333;color: white !important;">
                                            <tr>
                                                <th class="product-name"><span class="nobr">Order Id</span></th>
                                                <th class="product-price"><span class="nobr"> Order Date </span></th>
                                                <th class="product-add-to-cart"><span class="nobr"> Address </span></th>
                                                <th class="product-price"><span class="nobr">Payment Type</span></th>
                                                <th class="product-price"><span class="nobr">Order Status</span></th>
                                                <th class="product-add-to-cart"><span class="nobr"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php while ($row= mysqli_fetch_assoc($result)){


?>
                                            <tr>
                                                <td class="product-remove"><?= $row['id'] ?></td>
                                                <td class="product-thumbnail"><?= $row['addon'] ?></td>
                                                <td class="product-stock-status"><?= $row['address'] ?><br><?= $row['city'] ?><br><?= $row['pincode'] ?></td>
                                                <td class="product-thumbnail"><span class="amount"><?= $row['payment_type'] ?></span></td>
                                                <td class="product-thumbnail"><span class="wishlist-in-stock"><?= $row['order_status'] ?></span></td>
                                                <td style="text-decoration:underline;"><a href="order_details.php?id=<?php echo $row['id'] ?>"> view order details</a></td>
                                            </tr>

                                            <?php }?>
                                        </tbody>
                                    </table>
                                    <?php }else{
                                     echo "Empty";   
                                        
                                    }?>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php require('footer.php');
        ?>