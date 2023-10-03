<?php

require('top_side.php');
$product_name="";
$mrp="";
$price="";
$qty="";

if(isset($_GET['id'])){
    $proct_id=mysqli_real_escape_string($conn,$_GET['id']);
$proct_query="Select *,categories.category from product,categories where product.categories_id=categories.id and product.id='$proct_id'";
$result=mysqli_query($conn,$proct_query);
 $row = mysqli_fetch_assoc($result);
$product_name=$row['name'];
$mrp=$row['mrp'];
$price=$row["price"];
$qty=$row["qty"];
$cate_id=$row['categories_id'];



}


if (isset($_POST['submit'])) {
   $cat_id=mysqli_real_escape_string($conn, $_POST['categories_id']);
   $product=trim( mysqli_real_escape_string($conn, $_POST['name']));
   $mrp=trim( mysqli_real_escape_string($conn, $_POST['mrp']));
   $price=trim( mysqli_real_escape_string($conn, $_POST['price']));
   $qty=trim( mysqli_real_escape_string($conn, $_POST['qty']));
   $short_desc=mysqli_real_escape_string($conn, $_POST['short_desc']);
   $long_desc=mysqli_real_escape_string($conn, $_POST['Long_desc']);
   $meta_title=mysqli_real_escape_string($conn, $_POST['meta_title']);
   $Meta_desc=mysqli_real_escape_string($conn, $_POST['Meta_desc']);
   $Meta_keyword=mysqli_real_escape_string($conn, $_POST['Meta_keyword']);
   $count = mysqli_query($conn, "Select * from product where name='$product'");
$msg="";

   if (mysqli_num_rows($count) > 0) {
      if (isset($_GET['id']) && $_GET['id'] != 0) {
      $product_id = mysqli_real_escape_string($conn, $_GET['id']);
      $data = mysqli_fetch_assoc($count);
      if ($product_id == $data['id']) {

      } else {
         $msg = "Product Already Existed11!!";
      }}
      $msg = "Product Already Existed22!!";
}


if ($msg == "") {

      if (isset($_GET['id']) && $_GET['id'] != 0) {

         $Product_id = mysqli_real_escape_string($conn, $_POST['id']);

         $sql = "UPDATE categories SET category='$category' where id='$Cate_id'";
         mysqli_query($conn, $sql);
         header("location:categories.php?msg='Category Updated Successfully!!!' ");

      } else {
         $image=rand(111111,999999)."_".$_FILES['img']['name'];
      //   echo $_FILES['img']['name'];
         $targetimage='../media/product/'.$image;
         move_uploaded_file($_FILES['img']['tmp_name'],$targetimage);
         $sql = "INSERT INTO product ( `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES ( $cat_id, '$product', '$mrp', '$price', '$qty', '$image', '$short_desc', '$long_desc', '$meta_title', '$Meta_desc', '$Meta_keyword','1')";
         mysqli_query($conn, $sql);

      }
      // header("location:product.php");
      // die();
   } # code...
}

?>

<div class="content pb-0">
   <div class="animated fadeIn">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header"><strong>Product</strong><small>Form</small></div>
               <div class="card-body card-block">
                  <div class="error_l" style="    color: red;
    text-align: center" ;>
                     <?php echo @$msg; 
                     

                     $category_query="Select category,ID from categories where status=1";
                     $result_cate=mysqli_query($conn,$category_query);

                     
                     
                     ?>
                  </div>
                  <form method="post" enctype="multipart/form-data">
                  
                  <div class="form-group"><label for="Category" class=" form-control-label">Category</label><select class="form-control" name="categories_id" placeholder="Select category">
                      <option>Select Category</option> 
                        <?php while ($row1=mysqli_fetch_assoc($result_cate)) {
echo $cat_id;
                           if ($row1['ID']==$cate_id) {
                              echo "<option value='".$row1['ID']."' selected> ".$row1['category']."</option>";
                           }else{
                            echo "<option value='".$row1['ID']."'".$row1['category']."'> ".$row1['category']."</option>";
                           }# code...
                        }
                        ?>
                    </select>
                     <div class="form-group"><label for="Category" class=" form-control-label">Product Name</label><input
                           type="text" placeholder="Product name" name="name" class="form-control"
                           value="<?php echo $product_name; ?>"></div>


                           <div class="form-group"><label for="Category" class=" form-control-label">MRP</label><input
                           type="text" placeholder="Product name" name="mrp" class="form-control"
                           value="<?php echo $mrp; ?>"></div>


                           <div class="form-group"><label for="Category" class=" form-control-label">Price</label><input
                           type="text" placeholder="Product name" name="price" class="form-control"
                           value="<?php echo $price; ?>"></div>


                           <div class="form-group"><label for="Category" class=" form-control-label">Product Image</label><input
                           type="file" placeholder="Product name" name="img" class="form-control"></div>

                           <div class="form-group"><label for="Category" class=" form-control-label">QTY:</label><input
                           type="text" placeholder="Product name" name="qty" class="form-control"
                           value="<?php echo $qty; ?>"></div>

                           <div class="form-group"><label for="Category" class=" form-control-label">Short Description</label><input
                           type="text" placeholder="Product name" name="short_desc" class="form-control"
                           value="<?php echo $product_name; ?>"></div>

                           <div class="form-group"><label for="Category" class=" form-control-label">Long Description</label><textarea
                           placeholder="Product name" name="Long_desc" class="form-control"
                           value="<?php echo $product_name; ?>"> </textarea></div>

                           <div class="form-group"><label for="Category" class=" form-control-label">Meta Title:</label><input
                           type="text" placeholder="Product name" name="meta_title" class="form-control"
                           value="<?php echo $product_name; ?>"></div>

                           <div class="form-group"><label for="Category" class=" form-control-label">Meta Description</label><textarea
                           placeholder="Product name" name="Meta_desc" class="form-control"
                           value="<?php echo $product_name; ?>"> </textarea></div>
                           <div class="form-group"><label for="Category" class=" form-control-label">Meta keyword:</label><input
                           type="text" placeholder="Product name" name="Meta_keyword" class="form-control"
                           value="<?php echo $product_name; ?>"></div>
                     <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Add</span>
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<?php
require('footer.php');
?>


