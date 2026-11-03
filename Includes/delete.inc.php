<?php
require_once "function.inc.php";
$conn = dbconn();
$BookID = $_POST["BookID"];

$sql = "DELETE FROM ".BOOKTABLE." WHERE BookID = '".$BookID."'";

if ($conn -> query($sql)) {
    header("location:".BASEURL."/Admin/CatalogueAdmin.php");
    exit();
} else {
    stmtFailed();
}
?>
