<?php
require_once("config/connection.php");
    session_start();
    
    if(!isset($_SESSION["login_user"]) && $_SESSION["login_user"]["role"]==3){
        echo "<b> Access Denied<b>";
        print_r($_SESSION["login_user"]."S");
        die();
        return;
    }
    $user=$_SESSION["login_user"];
    $id=$user['id'];


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
    echo $bal;

    }
?>