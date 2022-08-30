<?php
require_once("../../config/connection.php");
$time= time();
// echo $time;
$sql="SELECT * FROM employee_info where lat_active_time>=$time-5";
if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    $row=mysqli_fetch_all($res,MYSQLI_ASSOC);
    if(mysqli_num_rows($res)==0){
        echo -1;
    }
    echo json_encode($row);

}




?>