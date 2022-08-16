<?php
require_once("../../config/connection.php");
$id=$_POST['id'];
// echo $time;
$sql="SELECT status FROM service where allocated_to=$id ";

if(!$res=mysqli_query($conn,$sql)){
    echo mysqli_error($conn);
}else{
    $p=0;
    $c=0;
   $com=0;
   while( $row=mysqli_fetch_assoc($res)){
        if($row['status']==2){
            $p++;
        } if($row['status']==3){
            $c++;
        }if($row['status']==4){
            $com++;
        }
   }
   $resp= array("pendingReq"=>$p,"complete"=>$com,"accept"=>$c);
   echo json_encode($resp);

}




?>