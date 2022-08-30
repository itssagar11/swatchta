<?php
require_once("../../config/connection.php");
$service=$_POST['service'];
$employee=$_POST['employee'];
$sql="update service set allocated_to=$employee ,status=2 ,remark='Allocated to employee Will we pickup soon.'where id=$service";

if(!mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
 echo 1;
  
}

?>