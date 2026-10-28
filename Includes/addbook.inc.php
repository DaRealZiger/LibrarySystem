<?php
require_once "function.inc.php";
$conn = dbconn();
$title = $_POST["title"];
$language= $_POST["language"];
$author = $_POST["author"];
$publisher= $_POST["publisher"];

$sql = "INSERT INTO ".BOOKTABLE." (BookName, Language, Author, Publisher, Status)
VALUES (?, ?, ?, ?, 'Available')";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ssss", $title, $language, $author, $publisher);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:".BASEURL."/Admin/CatalogueAdmin.html");
    exit();
} else {
    $error = mysqli_stmt_error($stmt);
    echo $error;
}
?>
