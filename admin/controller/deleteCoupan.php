
<?php
require_once("../../config/connection.php");
$id=$_GET['id'];
$sql="delete from coupan where coupan_id=$id";

if(mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    header("location:./coupan.php");
  
}

?>