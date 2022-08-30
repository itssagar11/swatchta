<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type:application/json;charset-UTF-8");
require_once("config/connection.php");

// print_r($_SERVER);
if($_SERVER['REQUEST_METHOD']=="POST"){
    $name=$_POST['name'];
    $lat=$_POST['lat'];
    $lon=$_POST['lon'];
    $company=$_POST['company'];
    $id=$_POST['customer_id'];
    $address=$_POST['address'];
    $sql="INSERT into garbagedataset (name,lat,lon,company,customer_id,status,address) VALUES('$name','$lat','$lon','$company','$id','0','$address')";
    $res=mysqli_query($conn,$sql);
    if(!$res){
        echo mysqli_error($conn);
    }else{
        echo 1;
    }
}else if($_SERVER['REQUEST_METHOD']=="GET"){
    $company=$_GET['company'];
    $sql="SELECT * from  garbagedataset where status=0";
    $res=mysqli_query($conn,$sql);
    if(!$res){
        echo mysqli_error($conn);
    }else{
        $row=mysqli_fetch_all($res,MYSQLI_ASSOC);
        echo json_encode($row);


    }

}else if($_SERVER['REQUEST_METHOD']=="PUT"){
    $id=$_GET['id'];
    $sql="UPDATE garbagedataset SET status=1 where id=$id";
    $res=mysqli_query($conn,$sql);
    if(!$res){
        echo mysqli_error($conn);
    }else{
       
        echo 1;


    }

}
?>