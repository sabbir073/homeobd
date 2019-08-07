<?php
include("auth.php");
?>
<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
}
else{
    header("Location: dashboard/index.php");
}