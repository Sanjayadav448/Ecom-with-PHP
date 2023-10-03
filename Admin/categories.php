<?php

require('top_side.php');
if($_SESSION['Admin_login']!=true){
header("location:login.php");
die();
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
    $sql="UPDATE categories SET status='$status' WHERE id='$id'";
    mysqli_query($conn, $sql);
}
}


if(isset($_GET['type'])&& $_GET['type']=="delete"){
$cid=mysqli_real_escape_string($conn,$_GET['id']);
mysqli_query($conn,"DELETE FROM categories WHERE id='$cid'");
}




$sql="Select * from categories order by category asc";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==0){
  $msg="Server Not Responding";

}




?>




         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body heading-body" style="
    display: flex;
    justify-content: space-between;>"
                           <h4 class="box-title">Categories </h4>
                           <a href="Add_category.php"><h4 class="box-title"  style="text-decoration:underline;cursor:pointer;">Add </h4></a>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>Category Name</th>
                                       <th></th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
<!--                                     
                                    -->

                                    <?php while($row=mysqli_fetch_assoc($result)){

                                     
                                    ?>
                                    <tr>
                                       <td class="serial"><?php echo $row['ID'];?></td>
                                       <td class="avatar"><?php echo $row['category'];?>
                                       </td>
                                       <td>
                                       <?php  
                                       if($row['status']==1){
                                        echo "<a href='?type=status&operation=deactive&id=".$row['ID']."'<span class='badge badge-complete'>Active</span> </a> &nbsp";

                                       }else{
                                        echo "<a href='?type=status&operation=active&id=".$row['ID']."'<span class='badge badge-pending'>Deactive</span> </a> &nbsp";

                                       };?>
                                      <?php echo "<a href='Add_category.php?id=".$row['ID']."'<span class='badge badge-info'>Edit</span> </a>";?>
                                      
                                      <?php echo "<a href='?type=delete&id=".$row['ID']."'<span class='badge badge-danger'>Delete</span> </a>";?>
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
         <?php require('footer.php')?>;
   </body>
</html>