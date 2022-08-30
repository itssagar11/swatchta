<?php
require('../../config/connection.php');
$mobile=$_POST['mobile'];
$pass=$_POST['pass'];
$name=$_POST['name'];
$root=$_POST['root'];
$vehicle=$_POST['vehicle'];

$last_id;
// echo $mobile.$pass.$name.$house.$address;
$account=rand(100000000,999999999);


$sql="INSERT into login (mobile_no,password,role) VALUES($mobile,$pass,2)";

if(!mysqli_query($conn,$sql)){
    mysqli_error($conn);
}else {
    $last_id = mysqli_insert_id($conn);
    $sql2="INSERT into employee_info (id,name,root,vehicle_no) VALUES($last_id,'$name','$root',$vehicle)";
    if(!mysqli_query($conn,$sql2)){
       echo  mysqli_error($conn);
    }else{
        
            echo 1;
        



    }

}
  



?>