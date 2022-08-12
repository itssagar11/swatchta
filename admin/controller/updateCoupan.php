<?php
require_once("../../config/connection.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $amount=mysqli_real_escape_string($conn,$_POST['amount']);
    $coins=mysqli_real_escape_string($conn,$_POST['coins']);
    $description=mysqli_real_escape_string($conn,$_POST['description']);
   
    $sql="UPDATE coupan set title='$title',amount=$amount,coins=$coins,description='$description'";
if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
   echo 1;
}
}else{
    echo "invalid";
}
?>