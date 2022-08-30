<?php
require_once("../../config/connection.php");


    $id=$_POST["id"];
    $sql='SELECT * FROM service where citizen_id ='.$id;
   


if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    $row=mysqli_fetch_all($res,MYSQLI_ASSOC);
//   echo $sql;
    echo json_encode($row);
}






?>