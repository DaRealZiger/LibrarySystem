<?php
require_once "function.inc.php";
$conn = dbconn();
$username= $_POST["username"];
$psw= $_POST["psw"];

$uidExists = usrExists($conn, $username);

if ($uidExists == false) {
    header("location:".BASEURL."/Registration/LogIn.php?error=WrongUsername");
    exit();
}

$storedPassword = $uidExists['Password'];

if ($psw !== $storedPassword) {
    header("location:".BASEURL."/Registration/LogIn.php?error=WrongPassword");
    exit();
} else {
    session_start();
    
    $_SESSION['Username'] = $uidExists['Username'];
    $_SESSION['Role'] = $uidExists['Role'];
    
    if (isAdmin()) {
        header("location:".BASEURL."/Admin/CatalogueAdmin.php");
        exit();
    }else {
        header("location:".BASEURL."/User/CatalogueUser.php");
        exit();
    }
}
?>
