<?php

require('top_side.php');

if(isset($_GET['type'])&& $_GET['type']=="delete"){
    $cid=mysqli_real_escape_string($conn,$_GET['id']);
    mysqli_query($conn,"DELETE FROM contact_us WHERE id='$cid'");
    }
    

$msg="";
$sql="Select * from contact_us order by id asc";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==0){
  $msg="No Query!!";
}


?>



<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body heading-body" style="
    display: flex;
    justify-content: space-between;">
                           <h4 class="box-title">Contact Us </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Mobile No.</th>
                                       <th>Query</th>
                                       <th>Date</th>
                                       <th></th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
<!--                                     
                                    -->

                                    <?php 
                                    if($msg==""){
                                    while($row=mysqli_fetch_assoc($result)){

                                     
                                    ?>
                                    <tr>
                                       <td class="serial"><?php echo $row['ID'];?></td>
                                       <td class="avatar"><?php echo $row['Name'];?></td>
                                       <td class="avatar"><?php echo $row['Email'];?></td>
                                       <td class="avatar"><?php echo $row['Mobile'];?></td>
                                       <td class="avatar"><?php echo $row['Query'];?></td>
                                       <td class="avatar"><?php echo $row['Date'];?></td>
                                       <td>  
                                      
                                      
                                      <?php echo "<a href='?type=delete&id=".$row['ID']."'<span class='badge badge-danger'>Delete</span> </a>";?>
                                      </td>
                                    </tr>
                                    <?php   } }  ?>
                                 </tbody>
                                 
                              </table>
                             
                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
            </div>
		  </div>
<?php require('footer.php');?>