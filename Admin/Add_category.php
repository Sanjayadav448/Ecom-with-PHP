<?php
require('top_side.php');
$msg = "";
$categories = "";

if (isset($_GET['id']) && $_GET['id'] != "") {

   $Cate_id = mysqli_real_escape_string($conn, $_GET['id']);
   $result_1 = mysqli_query($conn, "Select * from categories where id='$Cate_id'");
   if (mysqli_num_rows($result_1) > 0) {
      $row = mysqli_fetch_assoc($result_1);
      $categories = $row['category'];

   } else {
      header("Location:categories.php");
   }




}




if (isset($_POST['submit'])) {
   $category =trim( mysqli_real_escape_string($conn, $_POST['category']));
   
   $count = mysqli_query($conn, "Select * from categories where category='$category'");

   if (mysqli_num_rows($count) > 0) {
      $Cate_id = mysqli_real_escape_string($conn, $_GET['id']);
      $data = mysqli_fetch_assoc($count);
      if ($Cate_id == $data['ID']) {
         header("Location:categories.php");

      } else {
         $msg = "Category Already Existed!!";
      }
      $msg = "Category Already Existed!!";
   }

   if ($msg == "") {

      if (isset($_GET['id']) && $_GET['id'] != 0) {

         $Cate_id = mysqli_real_escape_string($conn, $_GET['id']);

         $sql = "UPDATE categories SET category='$category' where id='$Cate_id'";
         mysqli_query($conn, $sql);
         header("location:categories.php?msg='Category Updated Successfully!!!' ");

      } else {
         $sql = "Insert into categories(category,status) values('$category',1)";
         mysqli_query($conn, $sql);

      }
      header("location:categories.php");
      die();
   } # code...
}

?>


<div class="content pb-0">
   <div class="animated fadeIn">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header"><strong>Categoriesy</strong><small>Form</small></div>
               <div class="card-body card-block">
                  <div class="error_l" style="    color: red;
    text-align: center" ;>
                     <?php echo @$msg; ?>
                  </div>
                  <form method="post">
                     <div class="form-group"><label for="Category" class=" form-control-label">Category</label><input
                           type="text" placeholder="Category name" name="category" class="form-control"
                           value="<?php echo $categories; ?>"></div>
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


<?php require('footer.php');