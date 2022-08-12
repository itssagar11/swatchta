<?php
require_once("../../config/connection.php");

$sql="SELECT id ,name FROM employee_info";

if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    $obj=[];
   while($row=mysqli_fetch_assoc($res)){
        $obj[$row['id']]=$row['name'];
   }
   echo json_encode($obj);
  
}

?>