<?php
require_once("../../config/connection.php");

$sql="SELECT *FROM citizen ";


if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    $row=mysqli_fetch_all($res,MYSQLI_ASSOC);
//   echo $sql;
    echo json_encode($row);
}






?>