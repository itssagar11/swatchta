<?php
require_once("../config/connection.php");

// echo $time;
$id=$_POST['id'];
$time=time();
$sql="SELECT last_latt,last_long,last_location  FROM employee_info where id=$id ";

if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
   $resp=mysqli_fetch_assoc($res);
   
    echo json_encode($resp);
    
   }
 





?>