<?php
require_once("../../config/connection.php");

// echo $time;
$sql="SELECT status FROM garbagedataset ";

if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    $p=0;
    $c=0;
   
   while( $row=mysqli_fetch_assoc($res)){
        if($row['status']==1){
            $p++;}
        else if($row['status']==0){
            $c++;
        }
   }
   $resp= array("pendingReq"=>$c,"complete"=>$p);
   echo json_encode($resp);

}




?>