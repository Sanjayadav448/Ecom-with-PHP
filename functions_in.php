<?php



function getProduct($conn,$limit='',$cat_id='',$proc_id='')  {
    
$product_sql="Select * from product where status=1";
if ($proc_id!='') {
    $product_sql.=" and id=$proc_id";
    # code...
}
if ($cat_id!='') {
    $product_sql.=" and categories_id=$cat_id";
    # code...
}if ($limit!='') {
    $product_sql.=" limit $limit ";
    # code...
}
$result_pro = mysqli_query($conn, $product_sql);
$data=Array();
while ($row=mysqli_fetch_assoc($result_pro)) {
    $data[]=$row;# code...
}
return $data;

}
?>
