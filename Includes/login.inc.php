<?php
/* ------------------------- Call all functions  ------------------------- */
require_once "function.inc.php";

/* --------------------------- Defining Variables --------------------------- */
$conn = dbconn();
$username= $_POST["username"];
$psw= $_POST["psw"];
$usrExists = usrExists($conn, $username);
$storedPassword = $usrExists['Password'];

/* ----- If Username doesn't exists in table show Wrong Username Error  ----- */
if ($usrExists == false) {
    header("location:".BASEURL."/Registration/LogIn.php?error=WrongUsername");
    exit();
}

/* ------ If Password doesn't match username show Wrong Password Error ------ */
if ($psw !== $storedPassword) {
    header("location:".BASEURL."/Registration/LogIn.php?error=WrongPassword");
    exit();
} else {
/* ----------------------------- Start Session  ----------------------------- */
    session_start();
    
/* ------------------ Assign Username and Role to Session  ------------------ */
    $_SESSION['Username'] = $usrExists['Username'];
    $_SESSION['Role'] = $usrExists['Role'];

/* ------------------------ If Admin show admin page ------------------------ */
    if (isAdmin()) {
        header("location:".BASEURL."/Admin/CatalogueAdmin.php");
        exit();
    }else {
/* ------------------------- if User show user page ------------------------- */
        header("location:".BASEURL."/User/CatalogueUser.php");
        exit();
    }
}
?>
