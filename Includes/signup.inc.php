<?php
/* --------------------------- Call all functions --------------------------- */
require_once "function.inc.php";

/* --------------------------- Defining Variables --------------------------- */
$conn = dbconn();
$username= $_POST["username"];
$psw= $_POST["psw"];
$confirmPsw = $_POST["confirmPsw"];

/* ------------- If Username exists show Username Exists Error  ------------- */
if (usrExists($conn, $username) !== false) {
    header("location:".BASEURL."/Registration/SignUp.php?error=UserExists");
    exit();
}

/* ---- If Password and Confirmation Password is not the same show error ---- */
checkPassword($psw, $confirmPsw);

/* ------------------------ Preparing sql statement  ------------------------ */
$sql = "INSERT INTO ".USERTABLE." (Username, Password, Role)
VALUES (?, ?, 'user')";
$stmt = mysqli_stmt_init($conn);

/* ------------------------ Executing sql statement  ------------------------ */
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $username, $psw);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    session_start();
    
    $_SESSION['Username'] = $username;
    $_SESSION['Role'] = 'user';
    header("location:".BASEURL."/User/CatalogueUser.php");
    exit();
} else {
    $error = mysqli_stmt_error($stmt);
    echo $error;
}
?>
