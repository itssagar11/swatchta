
<?php
require_once("config/connection.php");
    session_start();
    
    if(!isset($_SESSION["login_user"]) && $_SESSION["login_user"]["role"]==3){
        echo "<b> Access Denied<b>";
        print_r($_SESSION["login_user"]."S");
        die();
        return;
    }


    function getName($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
      
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
      
        return $randomString;
    }
    $user=$_SESSION["login_user"];
    $bal;
    $id=$user['id'];
    $coupan_id=$_POST['id'];
    $price;
    $sql="SELECT SUM(amount) as a from transection where account_no=$id and mode='CREDIT'";
    if(!$res=mysqli_query($conn,$sql)){
        mysqli_error($conn);
    }else{
        $row=mysqli_fetch_assoc($res);
        $credit=$row['a'];
        $sql="SELECT SUM(amount) as a from transection where account_no=$id and mode='DEBIT'";
        if(!$res=mysqli_query($conn,$sql)){
            mysqli_error($conn);
        }
        $row=mysqli_fetch_assoc($res);
        $debit=$row['a'];

    $bal=$credit-$debit;
    }

    $sql="SELECT * FROM coupan where coupan_id=$coupan_id";
    if(!$res=mysqli_query($conn,$sql)){
        mysqli_error($conn);
    }else{
        $row=mysqli_fetch_assoc($res);
        $price=$row['amount'];
    }
    if($row['amount']>$bal){
        echo -1;
    }else{
        $code=getName(7);
       
        $sql="INSERT into rewards (owner,coupan,code) VALUES ($id,$coupan_id,'$code')";
        if(!mysqli_query($conn,$sql)){
            echo mysqli_error($conn);
        }else{
            $sql="INSERT into transection (amount,mode,narration,account_no) VALUES ($price,'DEBIT','Coupan Buy',$id)";
            if(!mysqli_query($conn,$sql)){
               echo  mysqli_error($conn);
            }else{
                echo 1;
            }
        }
    }


?>