<?php
session_start();
require_once "function.inc.php";
$conn = dbconn();
$BookID = $_POST["BookID"];
$username = $_SESSION["Username"];
$timezone = new DateTimeZone('Asia/Kuala_Lumpur');
$date = new DateTime('now', $timezone);
$borrowDate = $date -> format('Y-m-d');
$date -> modify('+2 weeks');
$dueDate = $date -> format('Y-m-d');

$sql = "INSERT INTO ".BORROWTABLE." (BookID, Username, BorrowedDate, DueDate)
VALUES (?, ?, '$borrowDate', '$dueDate')";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $BookID, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:".BASEURL."/User/CatalogueUser.php");
    exit();
} else {
    stmtFailed();
}
?>
