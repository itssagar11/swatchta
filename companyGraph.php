<?php
require_once("../../config/connection.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset-UTF-8");

// echo $time;
$sql="SELECT status FROM service ";

if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    $p=0;
    $c=0;
    $w=0;
    $d=0;
    $a=0;
   while( $row=mysqli_fetch_assoc($res)){
        if($row['status']==1){
            $p++;
        }else if($row['status']==2){
            $a++;
        }else if($row['status']==0){
            $d++;
        }
   }
   $resp= array("pendingReq"=>$p,"complete"=>$c,"withdraw"=>$w,"disaprrove"=>$d,"assigned"=>$a);
   echo json_encode($resp);

}




?>