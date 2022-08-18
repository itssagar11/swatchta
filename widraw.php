<?php
require_once("config/connection.php");
$id=$_GET['id'];
$sql="UPDATE service set status=0 ,remark='Request Widthdraw' where id=$id";
if(!mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    if(isset($_GET['notrf']) && $_GET['notrf']==1){
        echo 1;
    }else
    header('location:home.php');
}



?>