<?php
require_once("../../config/connection.php");
$sql="SELECT * FROM employee_info";

if(isset($_GET['com'])){
    if(!$res=mysqli_query($conn,$sql)){
        echo mysqli_error($conn);
    }else{
       
      $row=mysqli_fetch_all($res,MYSQLI_ASSOC);

       echo json_encode($row);
      
    }
    return;
}


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