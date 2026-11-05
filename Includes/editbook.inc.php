<?php
require_once "function.inc.php";
$conn = dbconn();
$bookID = $_POST["BookID"];
$title = $_POST["title"];
$language= $_POST["language"];
$author = $_POST["author"];
$publisher= $_POST["publisher"];
$status = $_POST["status"];

$sql = "UPDATE ".BOOKTABLE." SET BookName = ?, Language = ?, Author = ?, Publisher = ?, Status = ? WHERE BookID = ".$bookID;
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "sssss", $title, $language, $author, $publisher, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:".BASEURL."/Admin/CatalogueAdmin.php");
    exit();
} else {
    stmtFailed();
}
?>
