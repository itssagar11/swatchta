<?php 
require_once("../../config/connection.php");

$id=$_GET['id'];
$amount=$_GET['amount'];
$sql="select balance from employee_info where id=$id";
$res=mysqli_query($conn,$sql);
if(!$res){
    echo mysqli_error($conn);

}else{
    $row=mysqli_fetch_assoc($res);
    $bal=$row['balance'];
    $bal+=$amount;

    $sql="UPDATE employee_info set balance=$bal where id=$id";
    $res=mysqli_query($conn,$sql);
    if(!$res){
        echo mysqli_error($conn);
    }else{
        echo 1;
    }
}



?>