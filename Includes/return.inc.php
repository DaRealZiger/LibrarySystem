<?php
session_start();
require_once "function.inc.php";
$conn = dbconn();
$BookID = $_POST["BookID"];

$sql = "DELETE FROM ".BORROW." WHERE BookID = '".$BookID."'";

if ($conn -> query($sql)) {
    header("location:".BASEURL."/User/CatalogueUser.php");
    exit();
} else {
    stmtFailed();
}
?>
