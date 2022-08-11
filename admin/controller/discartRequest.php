<?php
require_once("../../config/connection.php");
$remark=$_POST['remark'];
$sql="UPDATE service set status=1,remark='$remark'";

if(!mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    echo 1;
}

?>