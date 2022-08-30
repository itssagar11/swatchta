<?php
require_once("config/connection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
  echo "<b> Access Denied<b>";
  print_r($_SESSION["login_user"] . "S");
  die();
  return;
}

$address=$_POST['address'];
$lat=$_POST['lat'];
$lon=$_POST['lon'];
$empId=$_SESSION['login_user']['id'];
$id=$_POST['id'];
$img= $_POST['img'];
$citizen= $_POST['citizen'];
$amount= $_POST['amount'];
$sql="SELECT balance from employee_info where id=$empId";
$res=mysqli_query($conn,$sql);
if(!$res){
    echo mysqli_error($conn);

}else{
    $row=mysqli_fetch_assoc($res);
    $bal=$row['balance'];

    if($amount>$bal){
      echo -1;
      echo $bal;
      return;
    }else{




      $bal-=$amount;

    $sql="UPDATE employee_info set balance=$bal where id=$empId";
    $res=mysqli_query($conn,$sql);
    if(!$res){
        echo mysqli_error($conn);
    }else{
       
      $sql1="INSERT INTO complete_service (service_id,image,address,lat,lon) VALUES($id,'$img','$address',$lat,$lon)";
if(!mysqli_query($conn,$sql1)){
   echo $mysqli_error($conn).$sql1; 
}else{
   $ro;
    $sql2="UPDATE service set status=4,remark='Service Completed' where id=$id";
    if(!mysqli_query($conn,$sql2)){
        echo $mysqli_error($conn); 
     }else{
      $sql="SELECT * FROM citizen where id=$citizen";
      if(!$r=mysqli_query($conn,$sql)){
         echo mysqli_error($conn).$sql;
      }else{
         $ro=mysqli_fetch_assoc($r);
         // print_r($ro);
         $account=$ro['account_no'];

      $sql="INSERT into transection (amount,mode,narration,account_no) VALUES($amount,'CREDIT','For Service no $id',$account)";
      if(!mysqli_query($conn,$sql)){
         echo mysqli_error($conn).$sql; 
      }else
        echo 1;
     }
   }
}





    }
    }
}







?>