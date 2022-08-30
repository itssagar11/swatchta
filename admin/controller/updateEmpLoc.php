<?php
require_once("../../config/connection.php");
 $time=time()-6;
$sql="SELECT last_latt ,last_long,last_location  FROM employee_info where  lat_active_time>='$time' ";
 $temp;
if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
  
   
    $i=0;
   while( $resp=mysqli_fetch_assoc($res)){
    $re;
    $re[0][0]=$resp['last_location'];
    $re[0][1]=$resp['last_latt'];
    $re[0][2]=$resp['last_long'];
   $temp[$i]=$re;
    $i++;
    
   }


    echo json_encode($temp);
    
   }
 





?>