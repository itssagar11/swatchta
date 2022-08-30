<?php
require('config/connection.php');
$mobile=$_POST['mobile'];
$pass=$_POST['pass'];
$name=$_POST['name'];
$house=$_POST['house'];
$address=$_POST['address'];

$last_id;
// echo $mobile.$pass.$name.$house.$address;
$account=rand(100000000,999999999);


$sql="INSERT into login (mobile_no,password,role) VALUES($mobile,$pass,3)";

if(!mysqli_query($conn,$sql)){
  echo  mysqli_error($conn);
}else {
    $last_id = mysqli_insert_id($conn);
    $sql2="INSERT into citizen (id,Full_name,houseNo,address,account_no) VALUES($last_id,'$name',$house,'$address',$account)";
    if(!mysqli_query($conn,$sql2)){
       echo  mysqli_error($conn);
    }else{
        if(isset($_POST['refer']) && $_POST['refer']!='' ){
            $by=$_POST['refer'];
            $sql="INSERT into refer (refer_by,refer_to) VALUES($by,$last_id)";
            if(!mysqli_query($conn,$sql)){
                echo mysqli_error($conn);
            }else{
                $sql="INSERT into transection (amount,mode,narration,account_no) VALUES(3,'CREDIT','For Refer',$by)";
                if(!mysqli_query($conn,$sql)){
                   echo mysqli_error($conn);
                }else{
                    echo 1;
                }
            }
            
        }else{
            echo 1;
        }



    }

}
  



?>