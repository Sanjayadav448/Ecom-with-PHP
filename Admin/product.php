<?php
require('top_side.php');

if (isset($_GET['type'])&& $_GET['type']=="delete"){

    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $delete_query="DELETE FROM product WHERE ID='$id'";
    mysqli_query($conn,$delete_query);
    # code...
}


if(isset($_GET['type']) && $_GET['type']!=""){
   $type=mysqli_real_escape_string($conn,$_GET['type']);
if($type=="status"){
   $operation=mysqli_real_escape_string($conn,$_GET['operation']);
   $id=mysqli_real_escape_string($conn,$_GET["id"]);
   if($operation=="active"){
       $status=1;
   }else{
       $status=0;
   }
   $sql="UPDATE product SET status='$status' WHERE id='$id'";
   mysqli_query($conn, $sql);
}
}

$sql="Select product.*,categories.category from product,categories where product.categories_id=categories.id";
$result=mysqli_query($conn,$sql);

?>




<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body heading-body" style="
    display: flex;
    justify-content: space-between;>"
                           <h4 class="box-title">Products </h4>
                           <a href="manage_product.php"><h4 class="box-title"  style="text-decoration:underline;cursor:pointer;">Add </h4></a>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>Category</th>
                                       <th>Name</th>
                                       <th>MRP</th>
                                       <th>Price</th>
                                       <th>Quantity</th>
                                       <th></th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
<!--                                     
                                    -->

                                    <?php while($row=mysqli_fetch_assoc($result)){

                                     
                                    ?>
                                    <tr>
                                       <td class="serial"><?php echo $row['id'];?></td>
                                       <td class="avatar"><?php echo $row['category'];?>
                                       <td class="avatar"><?php echo $row['name'];?>
                                       <td class="avatar"><?php echo $row['mrp'];?>
                                       <td class="avatar"><?php echo $row['price'];?>
                                       <td class="avatar"><?php echo $row['qty'];?>
                                       </td>
                                       <td>
                                       <?php  
                                       if($row['status']==1){
                                        echo "<a href='?type=status&operation=deactive&id=".$row['id']."'<span class='badge badge-complete'>Active</span> </a> &nbsp";

                                       }else{
                                        echo "<a href='?type=status&operation=active&id=".$row['id']."'<span class='badge badge-pending'>Deactive</span> </a> &nbsp";

                                       };?>
                                      <?php echo "<a href='manage_product.php?id=".$row['id']."'<span class='badge badge-info'>Edit</span> </a>";?>
                                      
                                      <?php echo "<a href='?type=delete&id=".$row['id']."'<span class='badge badge-danger'>Delete</span> </a>";?>
                                      </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>









<?php
require('footer.php');
?>