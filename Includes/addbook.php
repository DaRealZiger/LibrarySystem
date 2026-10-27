<?php
require_once "function.inc.php";
$conn = dbconn();
$title = $_POST["title"];
$language= $_POST["language"];
$author = $_POST["author"];
$publisher= $_POST["publisher"];

$sql = "INSERT INTO $BOOKTABLE  (BookName, Language, Author, Publisher, Status)
VALUES ('$title', '$language', '$author', '$publisher', 'Available')";

if ($conn -> query($sql) === TRUE){
    header("Location:../Admin/CatalogueAdmin.html");
    exit();
} else {
    echo "Error " . $sql . "<br>" . $conn -> error;
}
?>
