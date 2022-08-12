<?php
require_once("../../config/connection.php");
$remark=$_POST['remark'];
$id=$_POST['id'];
$sql="UPDATE service set status=0,remark='$remark' where id=$id";

if(!mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    echo 1;
}

?>