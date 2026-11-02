<?php
require_once "function.inc.php";
$conn = dbconn();
$username= $_POST["username"];
$psw= $_POST["psw"];
$confirmPsw = $_POST["confirmPsw"];

usrExists($conn, $username);
checkPassword($psw, $confirmPsw);

$sql = "INSERT INTO ".USERTABLE." (Username, Password, Role)
VALUES (?, ?, 'user')";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $username, $psw);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:".BASEURL."/User/CatalogueUser.php");
    exit();
} else {
    $error = mysqli_stmt_error($stmt);
    echo $error;
}
?>
