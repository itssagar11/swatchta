<?php
    require_once("config/connection.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_SESSION["login_user"])){
        session_unset();
    }
    $no= mysqli_real_escape_string($conn,$_POST["no"]);
    $pass= mysqli_real_escape_string($conn,$_POST["pass"]);
   
    $sql="SELECT * FROM `login` WHERE mobile_no='$no' And password='$pass'";
   if(!$result=$conn->query($sql)){
        echo mysqli_errno($conn)."rtttt";
        return;
   }
   if (mysqli_num_rows($result)>0){
       
         $res=mysqli_fetch_assoc($result);
         $role=$res['role'];
         $id=$res["id"];
         if($role==3){
            $sql2="SELECT * FROM citizen where id='$id' ";
            if(!$result2=$conn->query($sql2)){
                echo mysqli_errno($conn);
            }else{
                if(mysqli_num_rows($result2)>0){
                    $res2=mysqli_fetch_assoc($result2);
                    session_start();
                    $res2["role"]=$role;
                     $_SESSION["login_user"]=$res2;
          
                     echo 3;
                }
               
            }
         }else if($role==2){
            $sql2="SELECT * FROM employee_info where id='$id' ";
            if(!$result2=$conn->query($sql2)){
                echo mysqli_errno($conn);
            }else{
                if(mysqli_num_rows($result2)>0){
                    $res2=mysqli_fetch_assoc($result2);
                    session_start();
                    $res2["role"]=$role;
                     $_SESSION["login_user"]=$res2;
                     echo 2;
                 }
        }
    
}
         // session_start();
        // $_SESSION["login_user"]=$row;
        // if($row["isAdmin"]==1){
        //     echo 2;
        // }else{
        //     echo 1;
        // }
        
    }else{
        echo 0;
    }
}


mysqli_close($conn);




?>