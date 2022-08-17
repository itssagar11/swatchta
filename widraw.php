<?php
require_once("config/connection.php");
$id=$_GET['id'];
$sql="UPDATE service set status=0 where id=$id";
if(!mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    header('location:home.php');
}



?>