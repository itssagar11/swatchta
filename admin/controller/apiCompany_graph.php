<?php
require_once("../../config/connection.php");

// echo $time;
$sql="SELECT * FROM garbagedataset";

if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    $p=0;
    $c=0;
   
   while( $row=mysqli_fetch_assoc($res)){
        if($row['company']=='zomato'){
            $p++;}
        else if($row['company']=='swiggy'){
            $c++;
        }
   }
   $resp= array("zomato"=>$c,"swiggy"=>$p);
   echo json_encode($resp);

}




?>