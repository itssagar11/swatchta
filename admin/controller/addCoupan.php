<?php
require_once("../../config/connection.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $amount=mysqli_real_escape_string($conn,$_POST['amount']);
    $coins=mysqli_real_escape_string($conn,$_POST['coins']);
    $description=mysqli_real_escape_string($conn,$_POST['description']);
   
    $sql="INSERT into coupan(title,amount,coins,description) VALUES('$title',$amount,$coins,'$description')";
if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
   echo 1;
}
}else{
    echo "invalid";
}
?>