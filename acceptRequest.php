<?php
require_once("config/connection.php");
session_start();
if (!isset($_SESSION["login_user"]) || $_SESSION["login_user"]["role"] != 2) {
    echo "<b> Access Denied<b>";
    // print_r($_SESSION["login_user"] . "S");
    die();
    return;
}
$user = $_SESSION["login_user"];
$id = $_POST["id"];
$sql =  "UPDATE service set status=3,remark='Truck is on way for Pickup' where id=$id";
if (!mysqli_query($conn, $sql)) {
    echo mysqli_errno($conn);
} else {
   echo 1;
}

?>