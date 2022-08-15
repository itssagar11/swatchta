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
$sql = "SELECT latt,lon,address FROM service where id=$id";
if (!$result = mysqli_query($conn, $sql)) {
    echo mysqli_errno($conn);
} else {
    $res = mysqli_fetch_assoc($result);
    echo json_encode($res);
}

?>